<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
        })->paginate(10);
        return view('admin.user.show', compact('users'));
    }

    public function create()
    {
        $dosens = User::all();
        return view('admin.user.add', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:8',
                'role' => 'required',
            ],
            [
                'name.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'role.required' => 'Role tidak boleh kosong',

            ]
        );

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        if ($request->id_dosen != 0) {
            $user->id_dosen = $request->id_dosen;
        }
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $dosens = User::all();
        return view('admin.user.edit', compact('user', 'dosens'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'role.required' => 'Role tidak boleh kosong',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        if ($request->id_dosen != 0) {
            $user->id_dosen = $request->id_dosen;
        } else {
            $user->id_dosen = null;
        }
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        $user = User::find($user->id);
        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'User berhasil dihapus');
    }
}
