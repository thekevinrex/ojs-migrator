<?php

use App\Livewire\Users;
use App\Livewire\Issues;
use App\Livewire\Authors;
use App\Livewire\Welcome;
use App\Livewire\Publications;
use App\Livewire\Searchs;
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

Route::get('/', Welcome::class);
Route::get('/issues', Issues::class);
Route::get('/publications', Publications::class);
Route::get('/authors', Authors::class);
Route::get('/users', Users::class);
Route::get('/searchs', Searchs::class);
