<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::query();

        $pageTitle = 'Members';
    
        if ($request->has('role')) {
            $role = $request->input('role');
    
            if ($role === 'admin' || $role === 'staff' || $role === 'member') {
                $query->whereHas('user', function ($query) use ($role) {
                    $query->where('role', $role);
                });
            }

            if ($role === 'admin') {
                $pageTitle = 'Admins';
            } elseif ($role === 'staff') {
                $pageTitle = 'Staffs';
            } else {
                $pageTitle = 'Members';
            }            
        }
    
        $members = $query->whereNull('deleted_at')->get();
    
        return view('members.index', compact('members', 'pageTitle'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $data = $request->validated();
        
        if (!$data['username']) {
            $data['username'] = strtolower($data['first_name'] . $data['last_name']); // Automatically generate username
        }

        if (!$data['password']) { 
            $data['password'] = bcrypt('rotary2023'); // Hash the password
        } else {
            $data['password'] = bcrypt($data['password']); // Hash the password
        }

        // Create a new user record
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role'] ?? 'member', // Assuming the default role for new members is 'member'
        ]);

        $data['profile_picture'] = isset($data['profile_picture']) ? $data['profile_picture']->store('profile_pictures', 'public') : null;

        // Create the member record linked to the user
        $member = $user->member()->create([
            'first_name' => $data['first_name'],
            'middle_initial' => $data['middle_initial'],
            'last_name' => $data['last_name'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'mobile_number' => $data['mobile_number'],
            'address' => $data['address'],
            'rotary_id' => $data['rotary_id'], 
            'profile_picture' => $data['profile_picture'], 
            'member_at' => $data['member_at'], 
        ]);

        // Update the user record with the member_id
        $user->member_id = $member->id;
        $user->save();

        // Log the member creation
        Log::channel('member_management')->info('Member created', ['user_id' => auth()->user()->id, 'member_id' => $member->id]);

        return redirect()->route('members.index', ['role' => $data['role']])->with('success', 'Member registered successfully!');
    }

    public function edit(Member $member)
    {
        // Check if there is a success message in the session
        $successMessage = session('success');

        return view('members.edit', compact('member', 'successMessage'));
    }

    public function update(UpdateMemberRequest $request, Member $member)
    {
        $data = $request->validated();

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($member->profile_picture) {
                Storage::disk('public')->delete($member->profile_picture);
            }
    
            // Save the new profile picture
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            // Keep the existing profile picture if no new one is uploaded
            $data['profile_picture'] = $member->profile_picture;
        }
        
        // Update the member details
        $member->update([
            'first_name' => $data['first_name'],
            'middle_initial' => $data['middle_initial'],
            'last_name' => $data['last_name'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'mobile_number' => $data['mobile_number'],
            'address' => $data['address'],
            'rotary_id' => $data['rotary_id'],
            'profile_picture' => $data['profile_picture'],
            'member_at' => $data['member_at'],
        ]);

        // Update the corresponding user record's email and password (if provided)
        $user = $member->user;
        
        if ($data['email'] && $data['email'] !== $user->email) {
            $user->update(['email' => $data['email']]);
        }

        if ($data['password']) {
            $user->update(['password' => bcrypt($data['password'])]);
        }

        if ($data['username'] && $data['username'] !== $user->username) {
            $user->update(['username' => $data['username']]);
        }

        if ($data['role'] && $data['role'] !== $user->role) {
            $user->update(['role' => $data['role']]);
            // Log the member update
            Log::channel('member_management')->info('Member updated', ['user_id' => auth()->user()->id, 'member_id' => $member->id, 'role' => $data['role']]);
        }

        return redirect()->route('members.index', ['role' => $data['role']])->with('success', 'Member details updated successfully!');
    }

    public function destroy(Member $member)
    {
        $user = $member->user; // Get the associated user record

        if ($user) {
            $user->delete(); // Soft delete the user
        }

        // Soft delete the associated attendance records
        $member->attendances()->delete();
    
        $member->delete(); // Soft delete the member

        // Log the member deletion
        Log::channel('member_management')->info('Member soft deleted', ['user_id' => auth()->user()->id, 'member_id' => $member->id]);
        
        return redirect()->route('members.index', ['role' => $user->role])->with('success', 'Member deleted successfully!');
    }

    public function deletedMembers()
    {
        $members = Member::onlyTrashed()->get();
        $pageTitle = 'Deleted Members';
        return view('members.index', compact('members', 'pageTitle'));
    }

    public function restoreMember($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
    
        DB::transaction(function () use ($member) {
            $member->restore();

            // Restore the associated attendance records
            $member->attendances()->withTrashed()->restore();
    
            // Restore the associated user by setting deleted_at to null
            $user = User::withTrashed()->where('id', $member->user_id)->update(['deleted_at' => null]);
        });

        // Log the member restoration
        Log::channel('member_management')->info('Member restored', ['user_id' => auth()->user()->id, 'member_id' => $member->id]);
    
        return redirect()->route('members.index', ['role' => $member->user->role])->with('success', 'Member and user restored successfully.');
    }

    public function deletePermanently($id)
    {
        $member = Member::onlyTrashed()->findOrFail($id);
    
        DB::transaction(function () use ($member) {
            // Permanently delete the associated attendance records
            $member->attendances()->withTrashed()->forceDelete();

            // Permanently delete the member and related data if necessary
            $member->forceDelete();
    
            // Permanently delete the associated user
            User::withTrashed()->where('id', $member->user_id)->forceDelete();
        });

        // Log the member deletion
        Log::channel('member_management')->info('Member permanently deleted', ['user_id' => auth()->user()->id, 'member_id' => $member->id]);
    
        return redirect()->route('members.deleted')->with('success', 'Member and associated user deleted permanently.');
    }    

    public function profile()
    {
        $user = Auth::user();
        $member = $user->member;
        
        // Check if there is a success message in the session
        $successMessage = session('success');
        
        return view('members.profile', compact('member', 'successMessage'));
    }

    public function updateProfile(UpdateProfileRequest $request, Member $member)
    {
        
        $data = $request->validated();
        
        $user = Auth::user();
        $member = $user->member;

        if ($request->hasFile('profile_picture')) {
            // Delete the old profile picture if it exists
            if ($member->profile_picture) {
                Storage::disk('public')->delete($member->profile_picture);
            }
    
            // Save the new profile picture
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            // Keep the existing profile picture if no new one is uploaded
            $data['profile_picture'] = $member->profile_picture;
        }
        
        // Update the member details
        $member->update([
            'first_name' => $data['first_name'],
            'middle_initial' => $data['middle_initial'],
            'last_name' => $data['last_name'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'mobile_number' => $data['mobile_number'],
            'address' => $data['address'],
            'rotary_id' => $data['rotary_id'],
            'profile_picture' => $data['profile_picture']
        ]);

        // Update the corresponding user record's email and password (if provided)
        $user = $member->user;
        
        if ($data['email'] && $data['email'] !== $user->email) {
            $user->update(['email' => $data['email']]);
        }

        if ($data['password']) {
            $user->update(['password' => bcrypt($data['password'])]);
        }

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function uploadProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Set the allowed image types and size as needed
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');

            // You may want to store the $path in the database or use it for further processing

            return response()->json([
                'url' => asset('storage/' . $path),
                'path' => $path,
            ]);
        }

        return response()->json([
            'error' => 'File not found or invalid file format.',
        ], 400);
    }

}