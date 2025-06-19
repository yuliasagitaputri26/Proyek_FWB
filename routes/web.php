<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LayananAdminController;
use App\Http\Controllers\OrderStatusAdminController;
use App\Http\Controllers\OrderServicePetugasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderAdminController;
use App\Http\Controllers\CostumerOrderController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard redirect berdasarkan role
Route::get('/dashboard', function () {
    if (auth()->user()->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role == 'petugas') {
        return redirect()->route('petugas.dashboard');
    }
    return abort(403); // Jika role tidak dikenali
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin dashboard
Route::get('/dashboard-admin', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

// Petugas dashboard
Route::get('/dashboard-petugas', function () {
    return view('petugas.dashboard');
})->middleware(['auth'])->name('petugas.dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes
require __DIR__.'/auth.php';

// ======= ADMIN CRUD LAYANAN =======
Route::middleware(['auth'])->group(function () {
    Route::resource('services', ServiceController::class);
});

// ======= PETUGAS CRUD LAYANAN =======
Route::get('/layanan-petugas', [ServiceController::class, 'indexPetugas'])->middleware('auth')->name('services.petugas');

// ======= CRUD STATUS PESANAN (ADMIN) =======
Route::middleware(['auth'])->group(function () {
    Route::get('/status-pesanan', [OrderStatusController::class, 'index'])->name('order-status.index');
    Route::get('/status-pesanan/create', [OrderStatusController::class, 'create'])->name('order-status.create');
    Route::post('/status-pesanan', [OrderStatusController::class, 'store'])->name('order-status.store');
    Route::get('/status-pesanan/{id}/edit', [OrderStatusController::class, 'edit'])->name('order-status.edit');
    Route::put('/status-pesanan/{id}', [OrderStatusController::class, 'update'])->name('order-status.update');
    Route::delete('/status-pesanan/{id}', [OrderStatusController::class, 'destroy'])->name('order-status.destroy');
});

// ======= STATUS PESANAN PETUGAS =======
Route::get('/status-pesanan-petugas', [OrderStatusController::class, 'indexPetugas'])->middleware('auth')->name('order-status.petugas');

// ======= ORDER (Customer) =======
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::delete('/orders/{id}', [OrderController::class, 'destroy'])->name('orders.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/layanan', [LayananAdminController::class, 'index'])->name('admin.layanan');
    Route::get('/layanan/create', [LayananAdminController::class, 'create'])->name('admin.layanan.create');
    Route::post('/layanan', [LayananAdminController::class, 'store'])->name('admin.layanan.store');
    Route::get('/layanan/{id}/edit', [LayananAdminController::class, 'edit'])->name('admin.layanan.edit');
    Route::put('/layanan/{id}', [LayananAdminController::class, 'update'])->name('admin.layanan.update');
    Route::delete('/layanan/{id}', [LayananAdminController::class, 'destroy'])->name('admin.layanan.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/status', [OrderStatusAdminController::class, 'index'])->name('admin.status');
    Route::get('/status/create', [OrderStatusAdminController::class, 'create'])->name('admin.status.create');
    Route::post('/status', [OrderStatusAdminController::class, 'store'])->name('admin.status.store');
    Route::get('/status/{status}/edit', [OrderStatusAdminController::class, 'edit'])->name('admin.status.edit');
    Route::put('/status/{status}', [OrderStatusAdminController::class, 'update'])->name('admin.status.update');
    Route::delete('/status/{status}', [OrderStatusAdminController::class, 'destroy'])->name('admin.status.destroy');
});

use App\Http\Controllers\OrderServiceAdminController;

Route::middleware('auth')->group(function () {
    Route::get('/order-service', [OrderServiceAdminController::class, 'index'])->name('admin.order_service.index');
    Route::get('/order-service/create', [OrderServiceAdminController::class, 'create'])->name('admin.order_service.create');
    Route::post('/order-service', [OrderServiceAdminController::class, 'store'])->name('admin.order_service.store');
    Route::get('/order-service/{id}/edit', [OrderServiceAdminController::class, 'edit'])->name('admin.order_service.edit');
    Route::put('/order-service/{id}', [OrderServiceAdminController::class, 'update'])->name('admin.order_service.update');
    Route::delete('/order-service/{id}', [OrderServiceAdminController::class, 'destroy'])->name('admin.order_service.destroy');
});

Route::middleware(['auth'])->prefix('petugas')->group(function () {
    Route::get('/harga', [OrderServicePetugasController::class, 'index'])->name('petugas.order_service.harga');
    Route::get('/order-service', [OrderServicePetugasController::class, 'index'])->name('petugas.order_service.index');
    Route::get('/order-service/create', [OrderServicePetugasController::class, 'create'])->name('petugas.order_service.create');
    Route::post('/order-service', [OrderServicePetugasController::class, 'store'])->name('petugas.order_service.store');
    Route::get('/order-service/{id}/edit', [OrderServicePetugasController::class, 'edit'])->name('petugas.order_service.edit');
    Route::put('/order-service/{id}', [OrderServicePetugasController::class, 'update'])->name('petugas.order_service.update');
    Route::delete('/order-service/{id}', [OrderServicePetugasController::class, 'destroy'])->name('petugas.order_service.destroy');
});

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/layanan', [CostomerOrderController::class, 'daftarLayanan'])->name('customer.layanan');
});

Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/customer/layanan', [CostumerOrderController::class, 'index']);
Route::get('/customer/layanan/pesan/{id}', [CostumerOrderController::class, 'showPesananForm']);
Route::post('/customer/layanan/store', [CostumerOrderController::class, 'storePesanan']);
Route::post('/customer/pesan/{service}', [CostumerOrderController::class, 'store']);


Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/orders', [OrderAdminController::class, 'index'])->name('admin.orders.index');
});

Route::get('/customer/pesanan', [OrderController::class, 'index'])->name('customer.pesanan.index');
// Tampilkan form buat pesanan
Route::get('/customer/pesanan/create', [OrderController::class, 'create'])->name('orders.create');

// Simpan pesanan baru
Route::post('/customer/pesan/{service}', [CostumerOrderController::class, 'store'])->name('customer.pesan');

Route::post('/customer/pesan/{service}', [CostumerOrderController::class, 'store'])
     ->middleware('auth')
     ->name('customer.pesan');

Route::middleware('auth')->prefix('customer')->group(function () {
    Route::get('/pesan/create/{id}', [CostumerOrderController::class, 'create'])->name('customer.create');
    Route::post('/customer/pesan/store', [CostumerOrderController::class, 'storePesanan'])->name('customer.pesan.store');
    Route::get('/customer/pesanan', [CostumerOrderController::class, 'daftarPesanan'])->name('customer.pesanan.index');
});

Route::get('/', function () {
    return view('welcome'); // atau return view('landing');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/customer/layanan', [CostumerOrderController::class, 'index'])->name('customer.layanan');
});

Route::middleware('auth')->group(function () {
    Route::get('/edit-profil', [ProfileController::class, 'edit'])->name('profil.edit');
    Route::patch('/edit-profil', [ProfileController::class, 'update'])->name('profil.update');
});

Route::get('/transaksi/create', [TransactionController::class, 'create'])->name('Transaksi.create');
Route::post('/transaksi', [TransactionController::class, 'store'])->name('transaksi.store');

// Transaksi untuk Petugas
Route::get('/petugas/transaksi', [App\Http\Controllers\PetugasTransaksiController::class, 'index'])->name('petugas.TransaksiPetugas.index');




