<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('articles', 'ArticleController');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::middleware('auth')->group(function () {
    Route::resource('articles', 'ArticleController', [
        'only' => ['create', 'update']
        //'except' => ['index', 'show']
    ]);
    Route::get('/mes-articles', 'ArticleController@mesArticles')->name('mesarticles');
    // Route::get('/gestion/{id}/edit', 'GestionUtilisateurController@edit')->name('gestionutilisateuredit');
    // Route::put('/gestion/{id}/update', 'GestionUtilisateurController@update')->name('gestionutilisateurupdate');
    // Route::get('/gestion', 'GestionUtilisateurController@index')->name('gestionutilisateurindex');
    Route::resource('gestionUtilisateur', 'GestionUtilisateurController');
    Route::resource('categorie', 'CategorieController');
    Route::resource('subcategorie', 'SubCategorieController');
    Route::resource('message', 'MessageController');
    Route::get('/subcategorie/{id}/create', 'SubCategorieController@customcreate')->name('subcategorie.customcreate');

});
