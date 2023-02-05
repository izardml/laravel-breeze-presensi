<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

Route::prefix('dashboard')->middleware('auth', 'verified')->group(function () {
    Route::get('/', [AttendanceController::class, 'index'])->name('dashboard');
    Route::prefix('guru')->name('guru.')->group(function () {
        Route::get('/tambah', [AttendanceController::class, 'create'])->name('create');
        Route::post('/', [AttendanceController::class, 'store'])->name('store');
        Route::get('/{attendance}/detail', [AttendanceController::class, 'show'])->name('show');
        Route::delete('/{attendance}', [AttendanceController::class, 'destroy'])->name('destroy');
        // Route::get('/print', [AttendanceController::class, 'print'])->name('print');
    });
    Route::prefix('siswa')->name('siswa.')->group(function () {
        Route::get('/{attendance}/absen', [AttendanceController::class, 'edit'])->name('edit');
        Route::put('/{attendance}', [AttendanceController::class, 'update'])->name('update');
        Route::get('/riwayat', [AttendanceController::class, 'history'])->name('history');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
