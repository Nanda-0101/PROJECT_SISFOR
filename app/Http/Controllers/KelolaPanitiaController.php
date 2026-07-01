<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panitia;

class KelolaPanitiaController extends Controller
{
    public function index()
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        $panitias = Panitia::orderBy('id_panitia')->get();

        return view('admin.kelolaPanitia_admin', compact('panitias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_panitia' => 'required|max:100',
            'username'     => 'required|max:50|unique:panitia,username',
            'password'     => 'required|min:4',
            'status'       => 'required|in:aktif,nonaktif'
        ]);

        Panitia::create([
            'nama_panitia' => $request->nama_panitia,
            'username'     => $request->username,
            'password'     => $request->password,
            'status'       => $request->status
        ]);

        return back()->with('success','Panitia berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Panitia::findOrFail($id)->delete();

        return back()->with('success','Panitia berhasil dihapus.');
    }
}