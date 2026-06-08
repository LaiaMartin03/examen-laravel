<?php
    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\MessagesController;
    use App\Http\Controllers\DashboardController;

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

    Route::middleware('auth')->prefix('messages')->group(function () {
        Route::get('/create', [MessagesController::class, 'create'])->name('messages.create');
        Route::get('/index', [MessagesController::class, 'index'])->name('messages.index');
        Route::get('/{message}', [MessagesController::class, 'show'])->name('messages.show');
        Route::post('/', [MessagesController::class, 'store'])->name('messages.store');
    });
