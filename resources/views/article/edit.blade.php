@extends('layouts.app')

@section('content')


        <form method="POST" action="{{ route('articles.update', ['id' => $article->id]) }}">
            @method('PUT')
            {{ csrf_field() }}

            <p><input type="text" name="titre" placeholder="titre" value="{{ $article->titre }}"></p>
            <p><textarea type="text" name="texte" placeholder="texte">{{ $article->texte }}</textarea></p>
            <p><input type="submit" value="Modifier" ></p>

        </form>


@endsection