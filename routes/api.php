<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\FavorieController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;

Route::post('/login', [UserController::class, 'login']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('/register', [UserController::class, 'store']);
Route::resource('produits', ProduitController::class);
Route::resource('categories', CategorieController::class);
Route::resource('users', UserController::class);
Route::resource('roles', RoleController::class);

Route::resource('favories', FavorieController::class);
Route::resource('paniers', PanierController::class);
Route::resource('commandes', CommandeController::class);

Route::middleware('auth:sanctum')->post('/contact-us', [ContactController::class, 'store']);
Route::get('/admin/contact-messages', [ContactController::class, 'index']); // Pour voir les messages (admin)
Route::delete('/admin/contact-messages/{id}', [ContactController::class, 'destroy']); // Supprimer un message

