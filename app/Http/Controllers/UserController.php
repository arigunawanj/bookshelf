<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function beranda()
    {
        $user = User::all();
        return view('pengguna', compact('user'));
    }

    public function ubahData(Request $request, User $user)
    {
        $user->update([
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect('user');
    }
}
