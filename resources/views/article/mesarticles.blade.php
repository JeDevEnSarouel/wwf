@extends('layouts.app')

@section('content')
    <div class="row">
        <table class="table table-bordered">


        @foreach($articles as $article)
            <tr>
                <td><a href="/articles/{{$article->id}}">{{ $article->titre }}</a></td>
                <td><a href="{{ route('articles.edit', ['id' => $article->id]) }}">Modifier</a></td>
                <td><form method="POST" action="{{ route('articles.destroy', ['id' => $article->id]) }}">
                        @method('DELETE')
                        {{ csrf_field() }}
                        <input type="submit" value="Supprimer" >
                    </form></td>
            </tr>
        @endforeach
        </table>
    </div>
@endsection

