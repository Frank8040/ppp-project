<?php

use App\Livewire\Admin\Categories;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\MonitorPPP;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\RegisterPPP;
use App\Livewire\Admin\Roles;
use App\Livewire\Admin\SupervisorPPP;
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

    Route::get('/pagina/seguridad/roles', Roles::class)->middleware('can:admin.roles')->name('admin.roles');

    Route::get('/tabla/usuarios', Users::class)->middleware('can:admin.users')->name('admin.users');
    Route::get('/tabla/categorias', Categories::class)->middleware('can:admin.categories')->name('admin.categories');
    Route::get('/tabla/productos', Dashboard::class)->middleware('can:admin.products')->name('admin.products');

    Route::get('/tabla/registrar-ppp', RegisterPPP::class)->middleware('can:admin.register-ppp')->name('admin.register-ppp');
    Route::get('/tabla/supervisor-ppp', SupervisorPPP::class)->middleware('can:admin.supervisor-ppp')->name('admin.supervisor-ppp');
    Route::get('/tabla/monitorear-ppp', MonitorPPP::class)->middleware('can:admin.monitor')->name('admin.monitor');
});
