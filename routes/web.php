<?php

use App\Http\Controllers\DomainController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WhmController;
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

Route::get('/', function () {
	return view('index');
});
Route::get('/detay', function () {
	return view('inc.detay');
});


Route::post('/import', [ExcelController::class, 'veriAl'])->name('veri.al');
Route::get('/export', [ExcelController::class, 'veriCikart'])->name('veri.cikart');
Route::get('/export-non', [ExcelController::class, 'nonVeriCikart'])->name('non.veri.cikart');


Route::post('/domain/add', [WhmController::class, 'addSubdomain'])->name('add.domain');
Route::get('/domain/delete', [WhmController::class, 'delSubdomain'])->name('del.domain');



Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/admin', [DomainController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/domains', [DomainController::class, 'domainsPage'])->middleware(['auth', 'verified'])->name('admin.domains');
Route::get('/admin/nondomains', [DomainController::class, 'nondomainsPage'])->name('admin.nondomains');
Route::post('/admin/searchdomains', [DomainController::class, 'searchdomainsPage'])->name('admin.searchdomains');
Route::get('/admin/update_records', [DomainController::class, 'updateRecords'])->name('update.records');


Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
