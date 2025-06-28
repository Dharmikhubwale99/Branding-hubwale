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

    Route::get('/create', Create::class)->name('create')->middleware('can:customer-create');

    Route::get('/video-index', VideoIndex::class)->name('video.index')->middleware('can:video-index');
    Route::get('/video', Video::class)->name('video')->middleware('can:video-create');
    Route::get('/edit/{id}', Edit::class)->name('edit')->middleware('can:video-edit');
});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['web', 'auth', 'role:customer']], function(){
    Route::get('/', CustomerIndex::class)->name('index');
});
