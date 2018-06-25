<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Message;
use Gate;
use View;
use Validator;
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
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $messages = Message::all();
    // return view('gestionUtilisateurIndex',compact('users'));
    return View::make('message.index')
        ->with('messages', $messages);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    return View::make('message.create');
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
        'text'       => 'required',
    );
    $validator = Validator::make(Input::all(), $rules);

    // process the login
    if ($validator->fails()) {
        return Redirect::to('message/create')
            ->withErrors($validator);
    } else {
        // store
        $message = new Message;
        $message->text       = Input::get('text');
        $message->subcategorie_id     =     '1';
        $message->save();

        // redirect
        Session::flash('message', 'Message créé!');
        return Redirect::to('message');
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
    $message = Message::find($id);

    // show the view and pass the message to it
    return View::make('message.show')
        ->with('message', $message);
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
        abort(404,"Sorry, You can do this actions");
    }

    // get the nerd
    $message = Message::find($id);

    // show the edit form and pass the nerd
    return View::make('message.edit')
        ->with('message', $message);
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
        $message->save();

        // redirect
        Session::flash('message', 'Message modifiée!');
        return Redirect::to('message');
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
    $message = Message::find($id);
    $message->delete();

    // redirect
    Session::flash('message', 'Message supprimée');
    return Redirect::to('message');
  }
}
