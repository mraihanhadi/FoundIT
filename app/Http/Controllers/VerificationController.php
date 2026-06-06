<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemVerification;

class VerificationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'foto_bukti' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'no_telp' => 'required|string|max:20',
            'lokasi_ambil' => 'required|string|max:255',
            'janji_temu' => 'required|string|max:255',
        ]);

        $path = $request->file('foto_bukti')->store('verifications', 'public');

        ItemVerification::create([
            'item_id' => $request->item_id,
            'foto_bukti' => $path,
            'no_telp' => $request->no_telp,
            'lokasi_ambil' => $request->lokasi_ambil,
            'janji_temu' => $request->janji_temu,
            'status' => 'pending',
        ]);

        return response()->json(['success' => true, 'message' => 'Verifikasi berhasil dikirim ke Admin!']);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:claimed,invalid'
        ]);

        $verification = ItemVerification::findOrFail($id);
        $verification->status = $request->status;
        $verification->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui!']);
    }



}
