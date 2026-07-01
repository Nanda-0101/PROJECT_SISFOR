<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}