<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    /**
     * Menampilkan halaman login admin
     */
    public function index()
    {
        return view('admin.loginpage_admin');
    }

    /**
     * Proses login admin
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari admin berdasarkan username
        $admin = Admin::where('username', $request->username)->first();

        // Username tidak ditemukan
        if (!$admin) {
            return back()
                ->withInput()
                ->withErrors([
                    'username' => 'Username tidak ditemukan.'
                ]);
        }

        // Cek password (plain text)
        if ($request->password != $admin->password) {
            return back()
                ->withInput()
                ->withErrors([
                    'password' => 'Password salah.'
                ]);
        }

        // Simpan session
        session([
            'admin_login' => true,
            'id_admin'    => $admin->id_admin,
            'nama_admin'  => $admin->nama_admin,
        ]);

        // Redirect ke dashboard
        return redirect('/admin-dashboardadmin');
    }

    /**
     * Logout
     */
    public function logout()
    {
        session()->flush();

        return redirect('/admin-login');
    }
}
