@extends('layouts.app')

@section('content')
    <div>
    <h2>{{ $article->titre }}</h2>
        <p>{{ $article->texte }}</p>
        <p>Ecrit par <a href="mailto:{{$article->user->email}}">{{ $article->user->name }}</a></p>
    </div>
@endsection

