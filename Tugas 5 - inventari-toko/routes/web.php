<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/dashboard', function () {
    $totalProduk = \App\Models\Product::count();
    $totalStok = \App\Models\Product::sum('stock');
    $nilaiInventaris = \App\Models\Product::selectRaw('SUM(price * stock) as total')->value('total');
    $stokRendah = \App\Models\Product::where('stock', '<', 10)->get();
    
    return view('dashboard', compact('totalProduk', 'totalStok', 'nilaiInventaris', 'stokRendah'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('products', ProductController::class);
});

require __DIR__.'/auth.php';