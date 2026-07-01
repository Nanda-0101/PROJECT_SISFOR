<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Panitia;

class AdminKelolaEventController extends Controller
{
    public function index()
    {
        $events = Event::with('panitia')
            ->orderByDesc('id_event')
            ->paginate(10);

        $panitia = Panitia::where('status', 'aktif')
            ->orderBy('nama_panitia')
            ->get();

        $totalEvent  = Event::count();
        $eventAktif  = Event::where('status_event', 'publikasi')->count();
        $eventDraft  = Event::where('status_event', 'draft')->count();

        return view('admin.kelolaEvent_admin', compact(
            'events',
            'panitia',
            'totalEvent',
            'eventAktif',
            'eventDraft'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_event'    => 'required|string|max:255',
            'deskripsi'     => 'nullable|string',
            'tanggal_event' => 'required|date',
            'lokasi'        => 'required|string|max:255',
            'jenis_event'   => 'required|in:gratis,berbayar',
            'biaya'         => 'nullable|numeric|min:0',
            'status_event'  => 'required|in:draft,publikasi,selesai,dibatalkan',
            'created_by'    => 'required|exists:panitia,id_panitia',
        ]);

        $event = Event::findOrFail($id);

        $event->update([
            'nama_event'    => $request->nama_event,
            'deskripsi'     => $request->deskripsi,
            'tanggal_event' => $request->tanggal_event,
            'lokasi'        => $request->lokasi,
            'jenis_event'   => $request->jenis_event,
            'biaya'         => $request->jenis_event == 'gratis'
                                ? 0
                                : ($request->biaya ?? 0),
            'status_event'  => $request->status_event,
            'created_by'    => $request->created_by,
            'updated_by'    => session('admin_id'),
        ]);

        return redirect()
            ->route('admin.kelola.event')
            ->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::with('sesi.pendaftaran')->findOrFail($id);

        foreach ($event->sesi as $sesi) {
            $sesi->pendaftaran()->delete();
            $sesi->delete();
        }

        $event->delete();

        return redirect()
            ->route('admin.kelola.event')
            ->with('success', 'Event berhasil dihapus.');
    }
    public function complete($id)
    {
        $event = Event::findOrFail($id);

        $event->update([
            'status_event' => 'selesai'
        ]);

        return redirect()
            ->route('admin.kelola.event')
            ->with('success', 'Event berhasil diselesaikan.');
    }
}