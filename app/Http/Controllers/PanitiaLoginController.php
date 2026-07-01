<?php

namespace App\Http\Controllers;

use App\Models\Panitia;
use Illuminate\Http\Request;

class PanitiaLoginController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function index()
    {
        return view('panitia.loginpage_panitia');
    }

    /**
     * Proses login panitia.
     */
    public function login(Request $request)
    {
        $request->validate([
            'Username' => 'required',
            'Password' => 'required',
        ]);

        $panitia = Panitia::where('username', $request->Username)
            ->where('password', $request->Password)
            ->first();

        if (!$panitia) {
            return back()
                ->withErrors([
                    'login' => 'Username atau Password salah.'
                ])
                ->withInput();
        }

        // Simpan session
        session([
            'id_panitia'   => $panitia->id_panitia,
            'nama_panitia' => $panitia->nama_panitia,
            'username'     => $panitia->username,
        ]);

        return redirect()->route('panitia.dashboard');
    }

    /**
     * Logout panitia.
     */
    public function logout(Request $request)
    {
        $request->session()->forget([
            'id_panitia',
            'nama_panitia',
            'username',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('panitia.login');
    }
}