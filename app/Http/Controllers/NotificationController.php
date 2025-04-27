<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    // Get all notifications
    public function index(Request $request)
    {
        $notifications = Notification::all(); // Fetch notifications from the database

        // Pass both variables to the view using compact
        return view('notifications', compact('notifications'));
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
            'judul' => 'required|string|max:50',
            'isi' => 'required|string',
        ]);

        $notification = Notification::create($validated);
        // Log::info("hello world");
        // echo "hello world\n";
        return response()->json($validated, 201); // Return the created notification with a 201 status
    }

    // Update an existing notification
    public function update(Request $request, $id)
    {
        $notification = Notification::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'nullable|string|max:50',
            'isi' => 'nullable|string',
        ]);

        if (isset($validated['judul'])) {
            $notification->judul = $validated['judul'];
        }

        if (isset($validated['isi'])) {
            $notification->isi = $validated['isi'];
        }

        $notification->save();
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