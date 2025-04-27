<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    // Get all mahasiswas
    public function index()
    {
        return Mahasiswa::all();
    }

    // Get a specific mahasiswa by ID
    public function show($id)
    {
        return Mahasiswa::findOrFail($id);
    }

    // Create a new mahasiswa
    public function store(Request $request)
    {

        // Validate the incoming request data
        $validated = $request->validate([
            'nama' => 'required|string',
            'nim' => 'required|string|max:10',
            'angkatan' => 'required|integer',
            'role' => 'required|in:mahasiswa,humas,medinfo,eksekutif,pendidikan,ekraf',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $mahasiswa = Mahasiswa::create($validated);
        return response()->json($mahasiswa, 201); // Return the created mahasiswa with a 201 status
    }

    // Update an existing mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'nullable|string',
            'nim' => 'nullable|string|max:10',
            'angkatan' => 'nullable|integer',
            'divisi' => 'nullable|in:mahasiswa,humas,medinfo,eksekutif,pendidikan,ekraf',
            'email' => 'nullable|string',
            'password' => 'nullable|string'
        ]);

        if (isset($validated['nama'])) {
            $mahasiswa->nama = $validated['nama'];
        }

        if (isset($validated['nim'])) {
            $mahasiswa->nim = $validated['nim'];
        }

        if (isset($validated['angkatan'])) {
            $mahasiswa->angkatan = $validated['angkatan'];
        }

        if (isset($validated['divisi'])) {
            $mahasiswa->divisi = $validated['divisi'];
        }

        if (isset($validated['email'])) {
            $mahasiswa->email = $validated['email'];
        }

        if (isset($validated['password'])) {
            $mahasiswa->password = bcrypt($validated['password']);
        }

        $mahasiswa->save();
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