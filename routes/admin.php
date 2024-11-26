<?php

use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Yape;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::fallback(function () {
        return view('pages/utility/404');
    });

    Route::get('/sistema/dashboard/general', Dashboard::class)->middleware('can:admin.home')->name('admin.home');

    Route::get('/pagina/administrar-cuenta/perfil-personal', Profile::class)->middleware('can:admin.manage.profile')->name('admin.manage.profile');
    Route::get('/pagina/administrar-cuenta/yape', Yape::class)->middleware('can:admin.manage.yape')->name('admin.manage.yape');

    Route::get('/pagina/seguridad/roles', Roles::class)->middleware('can:admin.roles')->name('admin.roles');

    Route::get('/tabla/usuarios', Users::class)->middleware('can:admin.users')->name('admin.users');
    Route::get('/tabla/categorias', Categories::class)->middleware('can:admin.categories')->name('admin.categories');
    Route::get('/tabla/productos', Dashboard::class)->middleware('can:admin.products')->name('admin.products');
});
