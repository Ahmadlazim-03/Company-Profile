<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Get all notifications
    public function index()
    {
        return Notification::all();
    }

    // Get a specific notification by ID
    public function show($id)
    {
        return Notification::findOrFail($id);
    }

    // Create a new notification
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $notification = Notification::create($validated);
        return response()->json($notification, 201); // Return the created notification with a 201 status
    }

    // Update an existing notification
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        $notification->update($validated);
        return response()->json($notification, 200); // Return the updated notification with a 200 status
    }

    // Delete a notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return response()->noContent(); // Return a 204 No Content status
    }
}