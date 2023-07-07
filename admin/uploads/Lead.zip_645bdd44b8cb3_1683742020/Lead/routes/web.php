<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntryController;
use App\Http\Controllers\HomeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });




Route::get('/createEntry', [EntryController::class, 'create'] )->name('create')->middleware('auth', 'user:admin,writer');
Route::get('/', [EntryController::class, 'index'] )->name('main')->middleware('auth', 'user:admin,viewer,writer');
Route::get('/entry/{id}', [EntryController::class, 'show'] )->name('show')->middleware('auth', 'user:admin,viewer');
Route::post('/createEntry', [EntryController::class, 'store'])->name('entries.store')->middleware('auth');
Route::get('/createUser', [EntryController::class, 'createUser'] )->name('createUser')->middleware('auth', 'user:admin');
Route::post('/createUser', [EntryController::class, 'createUserPOST'] )->name('entries.createuser')->middleware('auth', 'user:admin');




// Route::get('/entry', [EntryController::class, 'index'])->middleware('auth');
// Route::get('/createEntry', [EntryController::class, 'create'])->middleware('auth');
// Route::get('/entry/{id}', [EntryController::class, 'show'])->middleware('auth');


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
