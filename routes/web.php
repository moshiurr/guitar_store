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

Route::middleware('auth')->group(function () {

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
    })->middleware(['verified'])->name('dashboard');

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
