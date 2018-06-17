@extends('layouts.app')

@section('content')
    <div>
    @foreach($articles as $article)
        <li><a href="/articles/{{$article->id}}">{{ $article->titre }}</a></li>
    @endforeach
    </div>
@endsection

