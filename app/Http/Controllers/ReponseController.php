<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\SubCategorie;
use \App\Message;
use \App\Reponse;
use Gate;
use View;
use Validator;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class ReponseController extends Controller
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
        'message_id' => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
      return View::make('subcategorie.show')
            ->with('subcategorie', $subcategorie)
            ->withErrors($validator);
    } else {
        // store
        $reponse = new Reponse;
        $reponse->text       = Input::get('text');
        $reponse->message_id     =     Input::get('message_id');
        $reponse->user_id = $user->id;
        $reponse->save();

        $subcategorie = SubCategorie::find($reponse->message->sub_categorie_id);


        // redirect
        Session::flash('message', 'Réponse créé!');
        return View::make('subcategorie.show')
          ->with('subcategorie', $subcategorie)
          ->with('id', $reponse->message->sub_categorie_id);


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
    $reponse = Reponse::find($id);

    // show the edit form and pass the nerd
    return View::make('reponse.edit')
      ->with('reponse', $reponse)
      ->with('id', $reponse->message->sub_categorie_id);

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
        return Redirect::to('reponse/' . $id . '/edit')
            ->withErrors($validator);
    } else {
        // store
        $reponse = Reponse::find($id);
        $reponse->text       = Input::get('text');
        $reponse->save();

        $subcategorie = SubCategorie::find($reponse->message->sub_categorie_id);

        Session::flash('message', 'Réponse modifié');
        return View::make('subcategorie.show')
          ->with('subcategorie', $subcategorie)
          ->with('id', $reponse->message->sub_categorie_id);

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
    $reponse = Reponse::find($id);
    $subcategorie = SubCategorie::find($reponse->message->sub_categorie_id);
    $reponse->delete();

    // redirect
    Session::flash('message', 'Réponse supprimé');
    return View::make('subcategorie.show')
      ->with('subcategorie', $subcategorie)
      ->with('id', $subcategorie->id);


  }
}
