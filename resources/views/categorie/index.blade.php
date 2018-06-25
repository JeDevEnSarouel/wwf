@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Catégories</div>
                <a href="{{ route('categorie.create') }}">Créer une nouvelle catégorie</a>
                <table class="table" style="width:100%">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($categories as $categorie)
                      <tr>
                        <td>{{$categorie->titre}}</td>
                        <td><a href="{{route('categorie.show', $categorie->id)}}" class="btn btn-success">Accéder</a>
                            <a href="{{route('categorie.edit', $categorie->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'categorie/' . $categorie->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                      </tr>

                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        
        <div class="col-md-4">
          <div class="card">
              <div class="card-header">Catégories</div>
              <a href="{{ route('categorie.create') }}">Créer une nouvelle catégorie</a>
              <table class="table" style="width:100%">
                <thead>
                  <tr>
                    <th>Nom</th>
                    <th>Action</th>
                  </tr>

                </thead>

                <tbody>
                  @foreach($categories as $categorie)
                    <tr>
                      <td>{{$categorie->titre}}</td>
                      <td><a href="{{route('categorie.show', $categorie->id)}}" class="btn btn-success">Accéder</a>
                          <a href="{{route('categorie.edit', $categorie->id)}}" class="btn btn-warning">Modifier</a>
                          {{ Form::open(array('url' => 'categorie/' . $categorie->id, 'class' => 'pull-right')) }}
                              {{ Form::hidden('_method', 'DELETE') }}
                              {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                          {{ Form::close() }}
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
