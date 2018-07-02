<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Gate;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class GestionUtilisateurController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!Gate::allows('isAdmin')){
            abort(404,"Sorry, You can't do this actions");
        }
        $users = User::all();
        // return view('gestionUtilisateurIndex',compact('users'));
        return View::make('gestionUtilisateur.index')
            ->with('users', $users);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(!Gate::allows('isAdmin')){
          abort(404,"Sorry, You can't do this actions");
      }
      // get the nerd
      $user = User::find($id);

      // show the edit form and pass the nerd
      return View::make('gestionUtilisateur.edit')
          ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if(!Gate::allows('isAdmin')){
          abort(404,"Sorry, You can't do this actions");
      }
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->save();
        session()->flash('message', 'Utilisateur mis à jour!');
        return redirect()->back();
    }

}
