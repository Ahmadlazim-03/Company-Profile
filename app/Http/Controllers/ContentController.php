<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    // Get all contents
    public function index()
    {
        return Content::with('user')->get(); // Assuming you have a relationship defined
    }

    // Get a specific content by ID
    public function show($id)
    {
        return Content::with('user')->findOrFail($id);
    }

    // Create a new content
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:dokumentasi_akademik,dokumentasi_non_akademik,publikasi_partnership,publikasi_medinfo,merchandise',
            'isi' => 'required|string',
            'gambar' => 'nullable|string', // Assuming this is a URL or path
            'user_id' => 'required|exists:users,id',
        ]);

        $content = Content::create($validated);
        return response()->json($content, 201); // Return the created content with a 201 status
    }

    // Update an existing content
    public function update(Request $request, $id)
    {
        $content = Content::findOrFail($id);
        
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'tipe' => 'required|in:dokumentasi_akademik,dokumentasi_non_akademik,publikasi_partnership,publikasi_medinfo,merchandise',
            'isi' => 'required|string',
            'gambar' => 'nullable|string',
        ]);

        $content->update($validated);
        return response()->json($content, 200); // Return the updated content with a 200 status
    }

    // Delete a content
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();
        return response()->noContent(); // Return a 204 No Content status
    }
}