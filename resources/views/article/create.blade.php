@extends('layouts.app')

@section('content')


        <form method="POST" action="{{ route('articles.store') }}">
            {{ csrf_field() }}

            <p><input type="text" name="titre" placeholder="titre"></p>
            <p><textarea type="text" name="texte" placeholder="texte"></textarea></p>
            <p><input type="submit" value="ajouter" ></p>


        </form>


@endsection