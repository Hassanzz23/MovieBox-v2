<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\HomeMovieController;
use App\Http\Controllers\Admin\UserController;



Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/signup', [AuthController::class, 'register'])->name('register');
Route::post('/signup', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index')
    ->middleware(['auth', 'banned']);

Route::get('/movies/{homeMovie}', [HomeController::class, 'show'])
    ->name('home-movie.show');

Route::get('/watchlist', [WatchlistController::class, 'index'])
    ->name('watchlist.index')
    ->middleware(['auth', 'banned']);

Route::post('/watchlist/add/{homeMovie}', [WatchlistController::class, 'add'])
    ->name('watchlist.add')
    ->middleware(['auth', 'banned']);

Route::get('/watchlist/search', [WatchlistController::class, 'search'])
    ->name('watchlist.search')
    ->middleware(['auth', 'banned']);

Route::get('/watchlist/select/{imdb_id}', [WatchlistController::class, 'selectOmdb'])
    ->name('watchlist.select')
    ->middleware(['auth', 'banned']);

Route::post('/watchlist', [WatchlistController::class, 'store'])
    ->name('watchlist.store')
    ->middleware(['auth', 'banned']);

Route::put('/watchlist/{movie}/watched', [WatchlistController::class, 'watched'])
    ->name('watchlist.watched')
    ->middleware(['auth', 'banned']);

Route::put('/watchlist/{movie}/rating', [WatchlistController::class, 'rate'])
    ->name('watchlist.rate')
    ->middleware(['auth', 'banned']);

Route::delete('/watchlist/{movie}', [WatchlistController::class, 'remove'])
    ->name('watchlist.remove')
    ->middleware(['auth', 'banned']);

Route::get('/watchlist/{movie}', [WatchlistController::class, 'show'])
    ->name('watchlist.show')
    ->middleware(['auth', 'banned']);

Route::get('/profile/change-name', [ProfileController::class, 'changeName'])
    ->name('profile.change-name')
    ->middleware(['auth', 'banned']);

Route::put('/profile/change-name', [ProfileController::class, 'updateName'])
    ->name('profile.update-name')
    ->middleware(['auth', 'banned']);

Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])
    ->name('profile.change-password')
    ->middleware(['auth', 'banned']);

Route::put('/profile/change-password', [ProfileController::class, 'updatePassword'])
    ->name('profile.update-password')
    ->middleware(['auth', 'banned']);

Route::get('/forget-password', [ForgetPasswordController::class, 'forgetPassword'])
    ->name('forget.password');

Route::post('/forget-password', [ForgetPasswordController::class, 'forgetPasswordPost'])
    ->name('forget.password.post');

Route::get('/reset-password/{token}', [ForgetPasswordController::class, 'resetPassword'])
    ->name('reset.password');

Route::post('/reset-password', [ForgetPasswordController::class, 'resetPasswordPost'])
    ->name('reset.password.post');

Route::get('/favorites', [FavoriteController::class, 'index'])
    ->name('favorites.index')
    ->middleware(['auth', 'banned']);

Route::post('/favorites/{movie}', [FavoriteController::class, 'add'])
    ->name('favorites.add')
    ->middleware(['auth', 'banned']);

Route::delete('/favorites/{movie}', [FavoriteController::class, 'remove'])
    ->name('favorites.remove')
    ->middleware(['auth', 'banned']);


Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        Route::get('/', [HomeMovieController::class, 'index'])
            ->name('admin');

        Route::resource(
            'home-movies',
            HomeMovieController::class
        );

        Route::post(
            'home-movies/reorder',
            [HomeMovieController::class, 'reorder']
        )->name('home-movies.reorder');

        Route::get(
            'users',
            [UserController::class, 'index']
        )->name('admin.users.index');

        Route::patch(
            'users/{user}/toggle-ban',
            [UserController::class, 'toggleBan']
        )->name('admin.users.toggle-ban');

        Route::get(
            'users/{user}',
            [UserController::class, 'show']
        )->name('admin.users.show');
    });
