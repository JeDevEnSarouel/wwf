<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Categorie;
use Gate;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class CategorieController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $categories = Categorie::all();
    // return view('gestionUtilisateurIndex',compact('users'));
    return View::make('categorie.index')
        ->with('categories', $categories);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    if(!Gate::allows('isAdmin')){
        abort(404,"Sorry, You can do this actions");
    }
    return View::make('categorie.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
        'titre'       => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return Redirect::to('categorie/create')
            ->withErrors($validator);
    } else {
        // store
        $categorie = new Categorie;
        $categorie->titre       = Input::get('titre');
        $categorie->save();

        // redirect
        Session::flash('message', 'Catégorie crée!');
        return Redirect::to('categorie');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    // get the nerd
    $categorie = Categorie::find($id);

    // show the view and pass the categorie to it
    return View::make('categorie.show')
        ->with('categorie', $categorie);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    if(!Gate::allows('isAdmin')){
        abort(404,"Sorry, You can do this actions");
    }
    // get the nerd
    $categorie = Categorie::find($id);

    // show the edit form and pass the nerd
    return View::make('categorie.edit')
        ->with('categorie', $categorie);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
        'titre'       => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return Redirect::to('categorie/' . $id . '/edit')
            ->withErrors($validator);
    } else {
        // store
        $categorie = Categorie::find($id);
        $categorie->titre       = Input::get('titre');
        $categorie->save();

        // redirect
        Session::flash('message', 'Catégorie modifiée!');
        return Redirect::to('categorie');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    // delete
    $categorie = Categorie::find($id);
    foreach ($categorie->subcategories as $subcategorie) {
      foreach ($subcategorie->messages as $message) {
        $message->delete();
      }
      $subcategorie->delete();
    }
    $categorie->delete();

    // redirect
    Session::flash('message', 'Catégorie supprimée');
    return Redirect::to('categorie');
  }
}
