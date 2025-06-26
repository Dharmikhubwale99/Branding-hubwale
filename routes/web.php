<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\{
    Auth\Login
};
use App\Livewire\Admin\{
    Dashboard,
    Create,
    Edit,
    Video,
    VideoIndex
};
use App\Livewire\Customer\{
    Index as CustomerIndex
};
use App\Http\Controllers\LogoutController;

Route::get('/', Login::class)->name('login');
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web', 'auth', 'role:admin']], function(){
    Route::get('/', Dashboard::class)->name('dashboard');

    Route::get('/create', Create::class)->name('create');
    Route::get('/edit/{id}', Edit::class)->name('edit');

    Route::get('/video-index', VideoIndex::class)->name('video.index');
    Route::get('/video', Video::class)->name('video');
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['web', 'auth', 'role:customer']], function(){
    Route::get('/', CustomerIndex::class)->name('index');
});
