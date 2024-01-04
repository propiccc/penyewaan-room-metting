<?php

use App\Models\Room;
use App\Models\Sewa;
use App\Models\User;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BungaController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PemesananController;

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
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');


    Route::prefix('room')->group(function(){
       Route::get('{uuid}/detail', [RoomController::class, 'RoomDetail'])->name('room.detail'); 
       Route::get('{uuid}/sewa', [SewaController::class, 'SewaCreate'])->middleware('auth')->name('room.sewa.create');
       Route::post('{uuid}/sewa/store', [SewaController::class, 'SewaStore'])->name('room.sewa.store');
    });


    Route::middleware('guest')->group(function(){
        Route::get('/login', [AuthController::class, 'viewLogin'])->name('login.view')->middleware('guest');
        Route::get('/register', [AuthController::class, 'viewRegister'])->name('register.view')->middleware('guest');
    });
    
    Route::prefix('auth')->middleware('guest:web')->group(function(){
        Route::post('/login', [AuthController::class, 'login'])->name('login.store');
        Route::post('/register', [AuthController::class, 'register'])->name('register.store');
    });

    Route::prefix('pemesanan')->middleware(['auth', 'role:customer'])->group(function(){
        Route::get('/', [PemesananController::class, 'index'])->name('pemesanan.index');
        Route::get('{uuid}/bayar', [PemesananController::class, 'BayarView'])->name('pemesanan.bayar.view');
        Route::post('{uuid}/bayar', [PemesananController::class, 'BayarStore'])->name('pemesanan.bayar.store');
    });

    
    Route::prefix('admin')->middleware('role:admin')->group(function(){
        Route::get('/dashboard', function(){
            $user = User::count();
            $customer = User::where('role', 'customer')->count();
            $room = Room::count();
            $sewa = Sewa::count();
            return view('Page.System.Admin.Dashboard.Index', ['user' => $user, 'customer' => $customer, 'room' => $room, 'pesanan' => $sewa]);
        })->name('admin.dashboard');

        Route::prefix('user')->group(function(){
            Route::get('/',[UserController::class, 'index'])->name('user.index');
            Route::get('/create',[UserController::class, 'create'])->name('user.create');
            Route::get('{uuid}/edit',[UserController::class, 'edit'])->name('user.edit');
            Route::post('{uuid}/update',[UserController::class, 'update'])->name('user.update');
            // Route::get('/',[UserController::class, 'index'])->name('user.delete');
            Route::post('/store',[UserController::class, 'store'])->name('user.store');
            Route::get('{uuid}/delete',[UserController::class, 'delete'])->name('user.delete');
        });

        Route::prefix('room')->group(function(){
            Route::get('/',[RoomController::class, 'index'])->name('room.index');
            Route::get('/create',[RoomController::class, 'create'])->name('room.create');
            Route::get('{uuid}/edit',[RoomController::class, 'edit'])->name('room.edit');
            Route::post('{uuid}/update',[RoomController::class, 'update'])->name('room.update');
            // Route::get('/',[RoomController::class, 'index'])->name('room.delete');
            Route::post('/store',[RoomController::class, 'store'])->name('room.store');
            Route::get('{uuid}/delete',[RoomController::class, 'delete'])->name('room.delete');
        });
        Route::prefix('pemesanan')->group(function(){
            Route::get('/',[PemesananController::class, 'indexPemesanan'])->name('admin.pemesanan.index');
            Route::get('{uuid}/detail',[PemesananController::class, 'DetailPemesanan'])->name('admin.pemesanan.detail');
            Route::post('/search',[PemesananController::class, 'search'])->name('admin.pemesanan.search');
            Route::get('{uuid}/terima',[PemesananController::class, 'TerimaPembayaran'])->name('admin.pemesanan.terima');
            Route::get('{uuid}/masuk',[PemesananController::class, 'SewaMasuk'])->name('admin.pemesanan.masuk');
            Route::get('{uuid}/selesai',[PemesananController::class, 'SewaSelesai'])->name('admin.pemesanan.selesai');
        });
    });

    


