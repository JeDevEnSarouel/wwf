<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\SubCategorie;
use \App\Message;
use Gate;
use View;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class MessageController extends Controller
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
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function customcreate($id)
  {
    return View::make('message.create')
      ->with('id', $id);

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    $user = Auth::user();
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
        'text'       => 'required',
        'sub_categorie_id' => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return View::make('subcategorie.show')
            ->with('subcategorie', $subcategorie)
            ->withErrors($validator);
    } else {
        // store
        $message = new Message;
        $message->text       = Input::get('text');
        $message->sub_categorie_id     =     Input::get('sub_categorie_id');
        $message->user_id = $user->id;
        $message->save();

        $subcategorie = SubCategorie::find($message->sub_categorie_id);


        // redirect
        Session::flash('message', 'Message créé!');
        return View::make('subcategorie.show')
          ->with('subcategorie', $subcategorie)
          ->with('id', $message->sub_categorie_id);


    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    if(!Gate::allows('isAdmin')  && !Gate::allows('isModo')){
        abort(404,"Sorry, You can't do this actions");
    }

    // get the nerd
    $message = Message::find($id);

    $subcategories = SubCategorie::all();
    foreach ($subcategories as $subcategorie) {
        $subcategoriesArray[$subcategorie->id] = $subcategorie->titre;
    }

    // show the edit form and pass the nerd
    return View::make('message.edit')
      ->with('message', $message)
      ->with('subcategoriesArray', $subcategoriesArray)
      ->with('id', $message->sub_categorie_id);

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    if(!Gate::allows('isAdmin')  && !Gate::allows('isModo')){
        abort(404,"Sorry, You can't do this actions");
    }
    // validate
    // read more on validation at http://laravel.com/docs/validation
    $rules = array(
        'text'       => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return Redirect::to('message/' . $id . '/edit')
            ->withErrors($validator);
    } else {
        // store
        $message = Message::find($id);
        $message->text       = Input::get('text');
        $message->sub_categorie_id       = Input::get('sub_categorie_id');
        $message->save();

        $subcategorie = SubCategorie::find($message->sub_categorie_id);

        Session::flash('message', 'Message modifié');
        return View::make('subcategorie.show')
          ->with('subcategorie', $subcategorie)
          ->with('id', $message->sub_categorie_id);

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
    if(!Gate::allows('isAdmin')  && !Gate::allows('isModo')){
        abort(404,"Sorry, You can't do this actions");
    }
    // delete
    $message = Message::find($id);
    $subcategorie = SubCategorie::find($message->sub_categorie_id);
    $message->delete();

    // redirect
    Session::flash('message', 'Message supprimé');
    return View::make('subcategorie.show')
      ->with('subcategorie', $subcategorie)
      ->with('id', $message->sub_categorie_id);


  }
}
