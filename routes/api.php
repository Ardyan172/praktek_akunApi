<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/transaction', [TransactionController::class, 'index']);
// // menampilkan data dari table
// Route::post('/transaction/store', [TransactionController::class, 'store']);
// // untuk menambahkan data
// Route::get('/transaction/show/{id}', [TransactionController::class, 'show']);
// // menampilkan data berdasarkan id
// Route::get('/transaction/destroy/{id}', [TransactionController::class, 'destroy']);
// // menghapus data berdasarkan id
// Route::put('/transaction/update/{id}', [TransactionController::class, 'update']);

// rute resource berguna untuk melakukan semua fitur CRUD, jadi tidak perlu menulis rute manual seperti diatas
// tapi nama method di transactionController jangan diubah karena nanti error
Route::resource('/transaction', TransactionController::class)->except('create', 'edit');
// except di gunakan agar url dan method create dan edit tidak bisa di akses

