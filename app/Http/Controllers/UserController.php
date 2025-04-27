<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }
    
    // Create a new user
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string',
            'email' => 'nullable|string',
            'password' => 'nullable|string',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $product = User::create($validated);
        return response()->json($product, 201); // Return the created product with a 201 status
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $mahasiswa = User::findOrFail($id);
        
        $validated = $request->validate([
            'nama' => 'nullable|string',
            'email' => 'nullable|string',
            'password' => 'nullable|string',
        ]);

        if (isset($validated['nama'])) {
            $mahasiswa->nama = $validated['nama'];
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

    public function show($id)
    {
        return User::findOrFail($id);
    }
}
