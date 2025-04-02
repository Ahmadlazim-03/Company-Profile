<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Get all mahasiswas
    public function index()
    {
        return Mahasiswa::with('user')->get(); // Assuming you have a relationship defined
    }

    // Get a specific mahasiswa by ID
    public function show($id)
    {
        return Mahasiswa::with('user')->findOrFail($id);
    }

    // Create a new mahasiswa
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'role' => 'required|in:undergraduate,graduate',
            'user_id' => 'required|exists:users,id',
        ]);

        $mahasiswa = Mahasiswa::create($validated);
        return response()->json($mahasiswa, 201); // Return the created mahasiswa with a 201 status
    }

    // Update an existing mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $validated = $request->validate([
            'nim' => 'required|string|max:20',
            'jurusan' => 'nullable|string|max:100',
            'role' => 'required|in:undergraduate,graduate',
        ]);

        $mahasiswa->update($validated);
        return response()->json($mahasiswa, 200); // Return the updated mahasiswa with a 200 status
    }

    // Delete a mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();
        return response()->noContent(); // Return a 204 No Content status
    }
}