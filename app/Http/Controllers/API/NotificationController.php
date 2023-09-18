<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{

    public function getAllNotifications()
    {
        $user = Auth::user();

        // Fetch all notifications for the user (both seen and unseen)
        $notifications = $user->notifications;

        return response()->json(['notifications' => $notifications]);
    }

    public function markAllNotificationsAsSeen()
    {
        $user = Auth::user();

        // Mark all notifications as seen
        $user->notifications()->update(['seen' => true]);

        return response()->json(['message' => 'All notifications marked as seen']);
    }

    public function clearSeenNotifications()
    {
        $user = Auth::user();
        // Get seen notifications for the user
        $seenNotifications = $user->notifications->where('seen', 1);

        // Delete each seen notification
        foreach ($seenNotifications as $notification) {
            $notification->delete();
        }

        return response()->json(['message' => 'Seen notifications cleared']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}