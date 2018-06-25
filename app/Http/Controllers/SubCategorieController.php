<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\SubCategorie;
use Gate;
use View;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
         ->with('subcategorie', $subcategories);
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return Response
    */
   public function create()
   {
       return View::make('subcategorie.create');
   }

   /**
    * Store a newly created resource in storage.
    *
    * @return Response
    */
   public function store()
   {
       //
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function show($id)
   {
       //
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return Response
    */
   public function edit($id)
   {
       //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function update($id)
   {
       //
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return Response
    */
   public function destroy($id)
   {
       //
   }

}
