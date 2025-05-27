<?php

use App\Http\Controllers\HomeController;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Login page
Route::get('/login', function () {
    return view('login');
})->name('login');

// Proses login
Route::post('/login', function (Request $request) {
    if ($request->username === 'dhanyrpebs' && $request->password === 'Rama@123') {
        session(['can_delete' => true]);
        return redirect()->route('keluarga.delete');
    }

    return redirect()->back()->withErrors(['login' => 'Username atau password salah']);
});

Route::post('/logout', function () {
    session()->forget('can_delete');
    return redirect()->route('login')->with('success', 'Logout sukses, sampai jumpa');
})->name('logout');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/input-kehadiran', [HomeController::class, 'input'])->name('savekehadiran');
Route::get('/keluarga', [HomeController::class, 'tampilkanKeluarga'])->name('keluarga.index');
Route::get('/keluarga/delete', function () {
    if (!session('can_delete')) return redirect()->route('login');
    $dataKeluarga = Person::all();
    return view('list', compact('dataKeluarga'));
})->name('keluarga.delete');

// Proses delete
Route::delete('/keluarga/{id}', function ($id) {
    if (!session('can_delete')) return redirect()->route('login');
    $item = Person::findOrFail($id);
    $item->delete();
    return back()->with('success', 'Data berhasil dihapus');
})->name('keluarga.destroy');


