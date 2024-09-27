<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('postLogin', [AuthController::class, 'postLogin'])->name('postLogin');



Route::middleware(['auth'])->group(function () {
   Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
   Route::get('/{invoice}/cetakInvoice', [PageController::class, 'cetakInvoice'])->name('cetakInvoice');
   Route::get('/{invoice}/view-invoice', [PageController::class, 'view'])->name('view');
   Route::get('/{invoice}/edit-invoice', [CrudController::class, 'edit'])->name('edit');
   // Route::get('/invoice/{invoice}/download', [PageController::class, 'cetakInvoice'])->name('invoice.download');

   Route::get('/invoices/filter', [PageController::class, 'filter'])->name('filter.invoices');


   // Route::get('/tambahInvoice', [PageController::class, 'tambahInvoice'])->name('tambahInvoice');
   Route::resource('/invoice', CrudController::class)->except('index');
   
});