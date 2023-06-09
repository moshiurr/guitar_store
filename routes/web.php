<?php

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard',[
        'name' => 'John Doe',
        'date' => 'June 8, 2023',
        'budget' => '5000',
        'total_expenses' => '2000',
        'recent_transactions' => [
            [
                "id" => 2,
                "price" => '49.47',
                "name" => 'Atlantic Superstore',
                "time" => '3h ago',
                "date" => '2023-01-23T13:23Z',
                "isDebit" => true,
            ],
            [
                "id" => 1,
                "price" => '402.67',
                "name" => 'Walmart',
                "time" => '3h ago',
                "date" => '2023-01-23T13:23Z',
                "isDebit" => false,
            ],
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
