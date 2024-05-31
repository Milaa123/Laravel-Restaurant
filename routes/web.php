<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReceiptContoller;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\ReceiptDetailController;
use App\Http\Controllers\ReportController;
use App\Http\Middleware\CheckRole;
use App\Models\Receipt;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth', [AuthController::class, 'index'])
->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])
->middleware('guest');

Route::get('/logout', [AuthController::class, 'logout'])
->name('logout');

Route::get('/', [DashboardController::class, 'index'])
->Middleware('auth');
Route::prefix('/')->middleware('auth')->group(
    function () {
        Route::resource('/user', UserController::class)->middleware('CheckRole:admin');
        Route::resource('/category', CategoryController::class);
        Route::resource('/menu', MenuController::class);
        Route::resource('/receipt', ReceiptController::class)->middleware('checkRole:admin,user');        Route::resource('/receipt-detail', ReceiptDetailController::class);
        Route::get('/report', [ReportController::class, 'index']);

    }

);



Route::middleware(['admin'])->group(function () {

});

Route::get('/dashboard', [DashboardController::class, 'index'])
->Middleware('auth');

Route::get('/ujilogin', function () {
    return view('profile');
})->middleware('my-login');

// require __DIR__ . '/auth.php';