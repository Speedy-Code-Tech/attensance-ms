<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $member = $this->route('member');
    
        return [
            'first_name' => 'required|string|max:255',
            'middle_initial' => 'nullable|string|max:2',
            'last_name' => 'required|string|max:255',
            'birthday' => 'nullable|date',
            'gender' => 'nullable|string|in:male,female,other',
            'mobile_number' => 'nullable|string|max:20',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($member->user->id),
            ],
            'address' => 'nullable|string|max:255',
            'rotary_id' => [
                'required',
                'string',
                Rule::unique('members', 'rotary_id')->ignore($member->id),
            ],
            'username' => [
                'nullable',
                'string',
                Rule::unique('users', 'username')->ignore($member->user->id),
            ],
            'password' => 'nullable|string|min:6',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}