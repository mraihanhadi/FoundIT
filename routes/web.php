<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AdminController;

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

    Route::get('/riwayat-posting', function () {
        return view('user.riwayatpostinganUser');
    })->name('user.riwayat.posting');

    Route::get('/edit-posting', function () {
        return view('user.editpostingUser');
    })->name('user.edit.posting');

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
        return view('user.notifikasiUser');
    })->name('user.notifikasi');

    Route::get('/verifikasi-barang', function () {
        return view('user.verifikasibarangUser');
    })->name('user.verifikasi.barang');

    Route::get('/profil', function () {
        $user = (object)[
            'nama'     => 'Kevin Liu',
            'username' => 'KevinKece22',
            'email'    => 'KevinLiu@gmail.com',
            'no_telp'  => '08123456789',
            'foto'     => null,
            'role'     => 'User',
        ];
        return view('user.profileUser', compact('user'));
    })->name('user.profil');

    Route::get('/profil/edit', function () {
        $user = (object)[
            'nama'     => 'Kevin Liu',
            'username' => 'KevinKece22',
            'email'    => 'KevinLiu@gmail.com',
            'no_telp'  => '08123456789',
            'foto'     => null,
            'role'     => 'User',
        ];
        return view('user.editprofileuser', compact('user'));
    })->name('user.edit.profil');

    Route::put('/profil/update', function () {
        return redirect()->route('user.profil')->with('success', 'Profil berhasil diperbarui!');
    })->name('user.update.profil');

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
    Route::get('/verifikasi', function () {
        return view('admin.VerifikasipenemuanAdmin');
    })->name('admin.verifikasi');
   Route::get('/setting', function () {
    $user = (object)[
        'nama'     => 'Admin',
        'username' => 'admin',
        'email'    => 'admin@foundit.ac.id',
        'no_telp'  => '08123456789',
        'foto'     => null,
        'role'     => 'Admin',
    ];
    return view('admin.profileAdmin', compact('user'));
})->name('admin.profil');
Route::get('/profil/edit', function () {
    $user = (object)[
        'nama'     => 'Admin',
        'username' => 'admin',
        'email'    => 'admin@foundit.ac.id',
        'no_telp'  => '08123456789',
        'foto'     => null,
        'role'     => 'Admin',
    ];
    return view('admin.editprofileAdmin', compact('user'));
})->name('admin.edit.profil');

Route::put('/profil/update', function () {
    return redirect()->route('admin.profil');
})->name('admin.update.profil');
Route::get('/verifikasi-status', function () {
    return view('admin.verifikasistatusAdmin');
})->name('admin.verifikasi.status');
Route::get('/tambah-posting', function () {
    return view('admin.tambahpostingAdmin');
})->name('admin.tambah.posting');
});
/* ── LOGOUT ── */
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');