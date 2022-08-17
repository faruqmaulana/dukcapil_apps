<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.users.index', [
            'users' => User::all()
        ]);
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect('/dashboard/users')->with('delete', 'Data pengguna berhasil dihapus!');
    }
    
    public function store(Request $request)
    {  
        $validatedData = $request->validate([
            "divisi" => "required",
            "jabatan" => "required",
            "role" => "required",
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/dashboard/users')->with('success', 'Data ' .ucfirst(strtolower($request["role"])).' berhasil ditambahkan');
    }

    public function update(Request $request)
    {   
        $validatedData = $request->validate([
            "divisi" => "required",
            "jabatan" => "required",
            "role" => "required",
            "name" => "required",
            "email" => "required",
            "password" => "required"
        ]);     

        User::where('id', $request->id)->update($validatedData);
        return back()->with('update', 'Data ' .ucfirst(strtolower($request["role"])).' berhasil diubah!');
    }
}
