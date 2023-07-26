<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome');
});

Route::get('/login', function () {
    sleep(2);
    return Inertia::render('Auth/Register');
})->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['verified'])->name('dashboard');

    Route::group(['prefix' => 'expense'], function (){
        Route::get('/', function () {
            return Inertia::render('Expense/Index');
        })->name('expense.index');

        Route::post('/', function () {
            return redirect()->route('dashboard');
        })->name('expense.store');

        Route::delete('/', function () {
            return Inertia::render('Expense/Index');
        })->name('expense.destroy');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');

    });
});

require __DIR__.'/auth.php';
