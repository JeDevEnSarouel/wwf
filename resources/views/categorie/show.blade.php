@extends('layouts.app')

@section('content')
<div class="container">
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Catégorie {{ $categorie->titre }}</div>
                <a href="{{ route('categorie.index') }}">Retour aux catégories</a>
                @if (Auth::user()->type == 'admin')
                <a href="{{ route('subcategorie.customcreate', $categorie->id) }}">Créer une sous catégorie</a>
                @endif

                <table class="table table-responsive">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($categorie->subcategories as $subcategorie)
                      <tr>

                        <td>{{ $subcategorie->titre }}</td>
                        <td><a href="{{route('subcategorie.show', $subcategorie->id)}}" class="btn btn-success">Accéder</a>
                          @if (Auth::user()->type == 'admin')

                            <a href="{{route('subcategorie.edit', $subcategorie->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'subcategorie/' . $subcategorie->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                          @endif
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
