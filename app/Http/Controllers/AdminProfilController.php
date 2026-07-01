<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminProfilController extends Controller
{
    public function index()
    {
        $admin = Admin::find(session('id_admin'));

        if (!$admin) {
            return redirect('/admin-login');
        }

        return view('admin.profil_admin', compact('admin'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => 'nullable|min:4|confirmed'
        ]);

        $admin = Admin::find(session('id_admin'));

        if ($request->filled('password')) {
            // karena database masih plain text
            $admin->password = $request->password;
            $admin->save();
        }

        return back()->with('success','Password berhasil diubah.');
    }
}