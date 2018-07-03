<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\SubCategorie;
use \App\Categorie;
use Gate;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;


class SubCategorieController extends Controller
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

    public function index()
   {
     $subcategories = subcategorie::all();

     return View::make('subcategorie.index')
         ->with('subcategories', $subcategories);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function customcreate($id)
   {
       if(!Gate::allows('isAdmin')){
           abort(404,"Sorry, You can do this actions");
       }
       return View::make('subcategorie.create')
        ->with('id', $id);

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
         'titre'        => 'required',
         'categorie_id' => 'required',
     );
     $validator = Validator::make(Input::all(), $rules);

     // process the login
     if ($validator->fails()) {
         return Redirect::to('subcategorie/categorie_id/create')
             ->withErrors($validator);
     } else {
         // store
         $subcategorie = new SubCategorie;
         $subcategorie->titre       = Input::get('titre');
         $subcategorie->categorie_id       = Input::get('categorie_id');
         $subcategorie->save();

         $categorie = Categorie::find($subcategorie->categorie_id);

         // redirect
         Session::flash('message', 'Sous catégorie crée!');
         return View::make('categorie.show')
            ->with('categorie', $categorie);

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
     $subcategorie = SubCategorie::find($id);












     // show the view and pass the categorie to it
     return View::make('subcategorie.show')
       ->with('subcategorie', $subcategorie)
       ->with('id', $id);
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
         abort(404,"Sorry, You can't do this actions");
     }
     // get the nerd
     $subcategorie = SubCategorie::find($id);

     // show the edit form and pass the nerd
     return View::make('subcategorie.edit')
         ->with('subcategorie', $subcategorie);
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
         //'categorie_id' => 'required',
     );
     $validator = Validator::make(Input::all(), $rules);

     // process the login
     if ($validator->fails()) {
         return Redirect::to('subcategorie/' . $id . '/edit')
             ->withErrors($validator);
     } else {
         // store
         $subcategorie = SubCategorie::find($id);
         $subcategorie->titre       = Input::get('titre');
         //$subcategorie->categorie_id       = Input::get('categorie_id');
         $subcategorie->save();
         $categorie = Categorie::find($subcategorie->categorie_id);

         // redirect
         Session::flash('message', 'Sous catégorie modifiée!');
         return View::make('categorie.show')
            ->with('categorie', $categorie);
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
     $subcategorie = SubCategorie::find($id);
     $categorie = Categorie::find($subcategorie->categorie_id);
     foreach ($subcategorie->messages as $message) {
       foreach ($message->reponses as $reponse) {
         $reponse->delete();
       }
       $message->delete();
     }
     $subcategorie->delete();

     // redirect
     Session::flash('message', 'Sous catégorie supprimée');
     return View::make('categorie.show')
        ->with('categorie', $categorie);
   }

}
