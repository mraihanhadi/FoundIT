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
}
