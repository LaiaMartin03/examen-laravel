<?php
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\EsdevenimentsController;
    use App\Http\Controllers\InscripcionsController; 

    Route::get('/', function () {
        return auth()->check() ? redirect()->route('inscipcions.index') : redirect()->route('login');
    });

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [EsdevenimentsController::class, 'index'])->name('dashboard');

    Route::middleware('auth')->prefix('esdeveniments')->group(function () {
        Route::get('/create', [EsdevenimentsController::class, 'create'])->name('esdeveniments.create');
        Route::post('/', [EsdevenimentsController::class, 'store'])->name('esdeveniments.store');
    });

    Route::prefix('inscripcions')->group(function () {
        Route::get('/', [InscripcionsController::class, 'index'])
            ->middleware('auth')
            ->name('inscripcions.index');

        Route::get('/{id}/create', [InscripcionsController::class, 'create'])->name('inscripcions.create');
        Route::post('/', [InscripcionsController::class, 'store'])->name('inscripcions.store');
    });
