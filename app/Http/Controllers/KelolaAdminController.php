<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class KelolaAdminController extends Controller
{
    /**
     * Tampilkan Halaman Kelola Admin
     */
    public function index()
    {
        if (!session('admin_login')) {
            return redirect('/admin-login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $admins = Admin::all();
        return view('admin.kelolaAdmin_admin', compact('admins'));
    }

    /**
     * Hapus Admin
     */
    public function destroy($id)
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        if (session('id_admin') == $id) {
            return redirect()->back()
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $admin = Admin::where('id_admin', $id)->firstOrFail();
        $admin->delete();

        return redirect()->back()
            ->with('success', 'Data Admin berhasil dihapus.');
    }
    public function store(Request $request)
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        $validator = Validator::make($request->all(), [
            'nama_admin' => 'required|max:100',
            'username'   => 'required|max:50|unique:admin,username',
            'password'   => 'required|min:4'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        Admin::create([
            'nama_admin' => $request->nama_admin,
            'username'   => $request->username,
            'password'   => $request->password
        ]);

        return redirect()
            ->route('admin.kelola.admin')
            ->with('success', 'Admin berhasil ditambahkan.');
    }
}