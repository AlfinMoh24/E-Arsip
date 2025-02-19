<?php

use App\Exports\DokumenExport;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Dokumen;
use App\Models\Peminjaman;
use App\Models\rak;
use App\Models\Ruang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', [DashboardController::class, 'index']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::redirect('/', '/admin/dashboard');

    Route::get('/dashboard', function () {
        return view('admin.dashboard.index', [
            'dokumen' => count(Dokumen::all()),
            'user' => count(User::all()),
            'transaksi' => count(Peminjaman::all()),
            'ruang' => count(Ruang::all()),
            'cart' => Ruang::withCount('dokumen')->get()
        ]);
    });

    // Route::resource('/rak', RakController::class)->except(['create', 'show', 'edit']);
    Route::resource('/user-peminjam', UserController::class)->except(['create', 'edit']);
    Route::get('/approval', [TransaksiController::class, 'approval'])->name('approval');
    Route::get('/pengembalian', [TransaksiController::class, 'pengembalian'])->name('pengembalian');
    Route::get('/peminjaman', [TransaksiController::class, 'riwayat'])->name('peminjaman');
    Route::put('/riwayat/{id}', [TransaksiController::class, 'updateApproval'])->name('approval.update');
    Route::put('/pengembalian/{id}', [TransaksiController::class, 'updatePengembalian'])->name('pengembalian.update');

    Route::get('/{type}', [MasterDataController::class, 'index'])->name('master.index');
    Route::post('/{type}', [MasterDataController::class, 'store'])->name('master.store');
    Route::put('/{type}/{id}', [MasterDataController::class, 'update'])->name('master.update');
    Route::delete('/{type}/{id}', [MasterDataController::class, 'destroy'])->name('master.destroy');
});

Route::get('/user', function () {
    return view('user.index', [
        'peminjamans' => Peminjaman::where('user_id', Auth::user()->id)->get()
    ]);
});
Route::get('/user/peminjaman', function () {
    return view('user.peminjaman');
})->middleware('user')->name('peminjaman.create');

Route::get('/user/peminjaman/{id}', [PeminjamanController::class, 'create'])->middleware('user')->name('peminjaman.create');
Route::post('/user/peminjaman/', [PeminjamanController::class, 'store'])->middleware('user')->name('peminjaman.store');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/change-password', function () {
    return view('auth.changePassword');
})->name('form-password')->middleware('auth');

Route::put('/change-password', [LoginController::class, 'update'])->name('password.update')->middleware('auth');

Route::resource('/dokumen', DokumenController::class);

Route::get('/export-dokumen', function () {
    return Excel::download(new DokumenExport, 'dokumen.xlsx');
})->name('dokumen.export');

Route::get('/download-private/{filename}', function ($filename) {
    $path = storage_path("app/private/data-dokumen/$filename");

    if (!file_exists($path)) {
        abort(404); // Jika file tidak ditemukan, tampilkan error 404
    }

    return response()->download($path);
})->name('file.download.private');


Route::get('/private-image/{filename}', function ($filename) {
    $path = storage_path("app/private/img/{$filename}");

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->file($path);
});
