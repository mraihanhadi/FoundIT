<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class AdminController extends Controller
{
    public function beranda()
    {
        // Admin gets all items to filter through them via tabs
        $items = Item::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.berandaAdmin', compact('items'));
    }

    public function approve($id)
    {
        $item = Item::findOrFail($id);
        $item->is_approved = true;
        $item->save();

        return redirect()->route('admin.beranda')->with('success', 'Postingan berhasil disetujui!');
    }

    public function reject($id)
    {
        $item = Item::findOrFail($id);
        // We delete the item if we reject it
        $item->delete();

        return redirect()->route('admin.beranda')->with('error', 'Postingan berhasil dihapus!');
    }

    public function verifikasi()
    {
        $verifications = \App\Models\ItemVerification::with('item')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
        $verificationsData = $verifications->map(function($v) {
            return [
                'id' => $v->id,
                'namaBarang' => $v->item->nama_barang ?? '-',
                'deskripsiBarang' => $v->item->deskripsi_barang ?? '-',
                'lokasiBarang' => $v->item->lokasi ?? '-',
                'fotoBarang' => $v->item && $v->item->foto ? asset('storage/'.$v->item->foto) : null,
                'fotoVerif' => asset('storage/'.$v->foto_bukti),
                'noTelp' => $v->no_telp,
                'lokasiAmbil' => $v->lokasi_ambil,
                'janjiTemu' => $v->janji_temu,
                'userId' => $v->item->user_id ?? null,
            ];
        });
        return view('admin.verifikasipenemuanAdmin', compact('verificationsData'));
    }

    public function approveVerification($id)
    {
        $verification = \App\Models\ItemVerification::findOrFail($id);
        $verification->status = 'approved';
        $verification->save();

        return response()->json(['success' => true, 'message' => 'Verifikasi berhasil dikirim ke user!']);
    }

    public function rejectVerification($id)
    {
        $verification = \App\Models\ItemVerification::findOrFail($id);
        $verification->status = 'rejected';
        $verification->save();

        return response()->json(['success' => true, 'message' => 'Verifikasi dihapus!']);
    }

    public function verifikasiStatus()
    {
        $verifications = \App\Models\ItemVerification::with('item')
            ->whereIn('status', ['approved', 'claimed', 'invalid'])
            ->orderBy('updated_at', 'desc')
            ->get();

        $statusList = $verifications->map(function ($v) {
            $responUser = 'belum';
            if ($v->status === 'claimed') $responUser = 'ya';
            elseif ($v->status === 'invalid') $responUser = 'tidak';

            return [
                'id' => $v->id,
                'itemId' => $v->item_id,
                'nama' => $v->item->nama_barang ?? '-',
                'lokasiAmbil' => $v->lokasi_ambil,
                'janji' => $v->janji_temu,
                'responUser' => $responUser,
                'status' => $v->item->status ?? 'Lost',
                'foto' => $v->item && $v->item->foto ? asset('storage/' . $v->item->foto) : null,
            ];
        });

        return view('admin.verifikasistatusAdmin', compact('statusList'));
    }

    public function updateItemStatus(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->status = $request->status;
        $item->save();
        
        return response()->json(['success' => true]);
    }
}
