<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panitia;

class KelolaPanitiaController extends Controller
{
    /**
     * Tampilkan Halaman Kelola Panitia
     */
    public function index()
    {
        if (!session('admin_login')) {
            return redirect('/admin-login')
                ->withErrors(['login' => 'Silakan login terlebih dahulu.']);
        }

        $panitias = Panitia::all();
        return view('admin.kelolaPanitia_admin', compact('panitias'));
    }

    /**
     * Hapus Panitia
     */
    public function destroy($id)
    {
        if (!session('admin_login')) {
            return redirect('/admin-login');
        }

        $panitia = Panitia::where('id_panitia', $id)->firstOrFail();
        $panitia->delete();

        return redirect()->back()
            ->with('success', 'Data Panitia berhasil dihapus.');
    }
}