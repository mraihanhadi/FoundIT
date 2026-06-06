<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VerificationController;

/*
|--------------------------------------------------------------------------
| WEB ROUTES — FOUNDIT
|--------------------------------------------------------------------------
*/

/* ── ROOT ── */
Route::get('/', function () {
    return redirect()->route('signin');
});

/* ── AUTH ── */
Route::get('/signin', function () {
    return view('signin');
})->name('signin');
Route::post('/signin', [AuthController::class, 'login_post'])->name('signin.post');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');
Route::post('/signup', [AuthController::class, 'register_post'])->name('signup.post');

/* ══════════════════════════════════════
   USER ROUTES
   Prefix  : /user
   Views   : resources/views/user/
══════════════════════════════════════ */
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {

    Route::get('/beranda', [ItemController::class, 'index'])->name('user.beranda');

    Route::get('/all-item', function () {
        return view('user.AllItemUser');
    })->name('user.allitem');

    Route::get('/tambah-posting', function () {
        return view('user.Tambahpostinguser');
    })->name('user.tambah.posting');
    Route::post('/tambah-posting', [ItemController::class, 'store'])->name('user.tambah.posting.post');

    Route::get('/riwayat-posting', [\App\Http\Controllers\ItemController::class, 'history'])->name('user.riwayat.posting');
    Route::delete('/item/{id}', [\App\Http\Controllers\ItemController::class, 'destroy'])->name('user.item.destroy');

    Route::get('/edit-posting/{id}', [\App\Http\Controllers\ItemController::class, 'edit'])->name('user.edit.posting');
    Route::post('/edit-posting/{id}', [\App\Http\Controllers\ItemController::class, 'update'])->name('user.update.posting');

    Route::get('/lapor-kehilangan', function () {
        return view('user.laporKehilanganUser');
    })->name('user.lapor.kehilangan');

    Route::get('/tambah-laporan', function () {
        return view('user.tambahlaporanUser');
    })->name('user.tambah.laporan');

    Route::get('/riwayat-lapor', function () {
        return view('user.riwayatlaporanUser');
    })->name('user.riwayat.lapor');

    Route::get('/edit-laporan', function () {
        return view('user.editlaporanUser');
    })->name('user.edit.lapor');

    Route::get('/notifikasi', function () {
        $notifikasis = \App\Models\ItemVerification::with('item')
            ->whereHas('item', function($q) {
                $q->where('user_id', \Illuminate\Support\Facades\Auth::id());
            })
            ->whereIn('status', ['approved', 'claimed', 'invalid'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        $notifikasiData = $notifikasis->map(function($v) {
            return [
                'id' => $v->id,
                'nama' => $v->item->nama_barang ?? '-',
                'deskripsi' => $v->item->deskripsi_barang ?? '-',
                'foto' => asset('storage/'.$v->foto_bukti),
                'nomor' => $v->no_telp,
                'lokasiAmbil' => $v->lokasi_ambil,
                'janji' => $v->janji_temu,
                'waktu' => $v->created_at->format('d/m/Y'),
                'status' => $v->status,
            ];
        });
        return view('user.notifikasiUser', compact('notifikasiData'));
    })->name('user.notifikasi');

    Route::get('/verifikasi-barang', function () {
        return view('user.verifikasibarangUser');
    })->name('user.verifikasi.barang');

    Route::post('/verifikasi', [VerificationController::class, 'store'])->name('user.verifikasi.store');
    Route::post('/verifikasi/{id}/status', [VerificationController::class, 'updateStatus'])->name('user.verifikasi.status');

    Route::get('/profil', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('user.profileUser', compact('user'));
    })->name('user.profil');

    Route::get('/profil/edit', function () {
        $user = \Illuminate\Support\Facades\Auth::user();
        return view('user.editprofileuser', compact('user'));
    })->name('user.edit.profil');

    Route::put('/profil/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('user.update.profil');

});

/* ══════════════════════════════════════
   ADMIN ROUTES
   Prefix  : /admin
   Views   : resources/views/admin/
══════════════════════════════════════ */
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/beranda', [AdminController::class, 'beranda'])->name('admin.beranda');
    Route::post('/item/{id}/approve', [AdminController::class, 'approve'])->name('admin.approve.postingan');
    Route::post('/item/{id}/reject', [AdminController::class, 'reject'])->name('admin.reject.postingan');
    Route::get('/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.verifikasi');
    Route::post('/verifikasi/{id}/approve', [AdminController::class, 'approveVerification'])->name('admin.approve.verifikasi');
    Route::post('/verifikasi/{id}/reject', [AdminController::class, 'rejectVerification'])->name('admin.reject.verifikasi');

   Route::get('/setting', function () {
       $user = \Illuminate\Support\Facades\Auth::user();
       return view('admin.profileAdmin', compact('user'));
   })->name('admin.profil');
Route::get('/profil/edit', function () {
    $user = \Illuminate\Support\Facades\Auth::user();
    return view('admin.editprofileAdmin', compact('user'));
})->name('admin.edit.profil');

Route::put('/profil/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('admin.update.profil');
Route::get('/verifikasi-status', [AdminController::class, 'verifikasiStatus'])->name('admin.verifikasi.status');
Route::put('/item/{id}/status', [AdminController::class, 'updateItemStatus'])->name('admin.item.update_status');
Route::get('/tambah-posting', function () {
    return view('admin.tambahpostingAdmin');
})->name('admin.tambah.posting');
});

/* ── LOGOUT ── */
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');