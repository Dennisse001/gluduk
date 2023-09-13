<?php
use App\Providers\RouteServiceProvider;     
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PostadminController;
use App\Models\PostAdmin;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('dash.admin');
    Route::get('/admin/logout', [AdminController::class, 'adminlogout'])->name('logout.admin');
    Route::get('/admin/profile', [AdminController::class, 'adminprofile'])->name('profile.admin');
    Route::post('/admin/profile/store', [AdminController::class, 'adminprofilestore'])->name('profile.admin.store');
    Route::post('/admin/profile/changepass', [AdminController::class, 'adminchangepass'])->name('change.admin.password');
    Route::get('/postingan', [PostadminController::class, 'lihatpost'])->name('admin.postingan');
    Route::get('/tambahpost', [PostadminController::class, 'uploadpost'])->name('admin.uploadp');
    Route::post('/insertpost', [PostadminController::class, 'tambahpost'])->name('tambahpost');
    Route::get('/tampilpost/{id}', [PostadminController::class, 'tampilpost'])->name('tampilpost');
    Route::post('/editpost/{id}', [PostadminController::class, 'editpost'])->name('editpost');
    Route::get('/deletepost/{id}', [PostadminController::class, 'deletepost'])->name('deletepost');




});


Route::middleware(['auth', 'role:penjual]'])->group(function () {
Route::get('/penjual/dashboard', [PenjualController::class, 'penjualdashboard'])->name('dash.penjual');
});





