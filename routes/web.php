<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('dashboard.locales')->group(function () {
    Auth::routes();
});

Route::impersonate();

Route::redirect('/', '/dashboard');
Route::redirect('/home', '/dashboard');


Route::get('/clearcache', function() {
    Artisan::call('cache:clear');
	 	Artisan::call('config:cache');
 	Artisan::call('storage:link');
     
    return 'Application cache has been cleared';
});