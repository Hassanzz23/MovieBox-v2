<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\ForgetPasswordController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\Admin\HomeMovieController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/signup', [AuthController::class, 'register'])->name('register');
Route::post('/signup', [AuthController::class, 'registerPost'])->name('register.post');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile.index')
    ->middleware('auth');

Route::get('/movies/{homeMovie}', [HomeController::class, 'show'])
    ->name('home-movie.show');

Route::get('/watchlist', [WatchlistController::class, 'index'])
    ->name('watchlist.index')
    ->middleware('auth');

Route::post('/watchlist/add/{homeMovie}', [WatchlistController::class, 'add'])
    ->name('watchlist.add')
    ->middleware('auth');

Route::get('/watchlist/search', [WatchlistController::class, 'search'])
    ->name('watchlist.search')
    ->middleware('auth');

Route::get('/watchlist/select/{imdb_id}', [WatchlistController::class, 'selectOmdb'])
    ->name('watchlist.select')
    ->middleware('auth');

Route::post('/watchlist', [WatchlistController::class, 'store'])
    ->name('watchlist.store')
    ->middleware('auth');

Route::put('/watchlist/{movie}/watched', [WatchlistController::class, 'watched'])
    ->name('watchlist.watched')
    ->middleware('auth');

Route::put('/watchlist/{movie}/rating', [WatchlistController::class, 'rate'])
    ->name('watchlist.rate')
    ->middleware('auth');

Route::delete('/watchlist/{movie}', [WatchlistController::class, 'remove'])
    ->name('watchlist.remove')
    ->middleware('auth');

Route::get('/watchlist/{movie}', [WatchlistController::class, 'show'])
    ->name('watchlist.show')
    ->middleware('auth');

Route::get('/profile/change-name', [ProfileController::class, 'changeName'])
    ->name('profile.change-name')
    ->middleware('auth');

Route::put('/profile/change-name', [ProfileController::class, 'updateName'])
    ->name('profile.update-name')
    ->middleware('auth');

Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])
    ->name('profile.change-password')
    ->middleware('auth');

Route::put('/profile/change-password', [ProfileController::class, 'updatePassword'])
    ->name('profile.update-password')
    ->middleware('auth');

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
    ->middleware('auth');

Route::post('/favorites/{movie}', [FavoriteController::class, 'add'])
    ->name('favorites.add')
    ->middleware('auth');

Route::delete('/favorites/{movie}', [FavoriteController::class, 'remove'])
    ->name('favorites.remove')
    ->middleware('auth');


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
    });
