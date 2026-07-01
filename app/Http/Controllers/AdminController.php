<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Panitia;

class AdminController extends Controller
{
    /**
     * Tampilkan Halaman Kelola Admin
     */
    public function indexAdmin()
    {
        // Pengaman Sesi: Harus login sebagai admin
        if (!session('admin_login')) {
            return redirect('/admin-login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $admins = Admin::all(); 
        return view('admin.kelolaAdmin_admin', compact('admins'));
    }

    /**
     * Fungsi Aksi Hapus Admin
     */
    public function destroyAdmin($id)
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        // Validasi: Mencegah admin menghapus akunnya sendiri yang sedang aktif digunakan
        if (session('id_admin') == $id) {
            return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $admin = Admin::where('id_admin', $id)->firstOrFail();
        $admin->delete(); 
        
        return redirect()->back()->with('success', 'Data Admin berhasil dihapus.');
    }

    /**
     * Tampilkan Halaman Kelola Panitia
     */
    public function indexPanitia()
    {
        if (!session('admin_login')) {
            return redirect('/admin-login')->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $panitias = Panitia::all(); 
        return view('admin.kelolaPanitia_admin', compact('panitias'));
    }

    /**
     * Fungsi Aksi Hapus Panitia
     */
    public function destroyPanitia($id)
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        $panitia = Panitia::where('id_panitia', $id)->firstOrFail();
        $panitia->delete(); 
        
        return redirect()->back()->with('success', 'Data Panitia berhasil dihapus.');
    }
}