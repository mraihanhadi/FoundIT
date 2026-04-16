<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('user')->where('is_approved', true)->orderBy('created_at', 'desc')->get();
        return view('user.Berandauser', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi_barang' => 'required|string',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:Lost,Found',
            'tanggal' => 'required|date',
            'contact_person' => 'nullable|string|max:255',
            'janji_temu' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $itemData = $request->except('foto');
        $itemData['user_id'] = Auth::id();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('items', 'public');
            $itemData['foto'] = $path;
        }

        Item::create($itemData);

        return redirect()->route('user.riwayat.posting')->with('success', 'Postingan berhasil ditambahkan!');
    }
}
