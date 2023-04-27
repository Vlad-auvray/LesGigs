<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*  
Rappel concernant les routes et les verbes associés :
    
    GET (TOUS)         -    index 
    GET		           -    create	
    POST	    -    store	
    GET	(UN SEUL)	    -    show	
    GET		    -    edit	
    PUT/PATCH	-	 update	
    DELETE	    -    destroy 	
    
    */

// On indique que la route doit se réferer au controller avec une méthode (index et show)
Route::get('/', [ListingController::class, 'index']);

// Afficher le formulaire de création
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Enregistrer les données
Route::post('/listings/', [ListingController::class, 'store'])->middleware('auth');

// Afficher le formulaire d'édition, MAJ,

Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Envoyer la MAJ
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Supprimer un item
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Gérer les items
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// Afficher un seul item (à mettre en dernier pour éviter des conflits avec les autres routes)
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Afficher la page création d'user
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Creer nouveau user
Route::post('/users', [UserController::class, 'store']);

// Se déconnecter
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Afficher le formulaire de connexion
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//Se connecter
Route::post('/users/authenticate', [UserController::class, 'authenticate']);





