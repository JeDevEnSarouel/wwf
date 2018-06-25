@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Catégorie {{ $categorie->titre }}</div>
                <a href="{{ route('categorie.index') }}">Retour aux catégories</a>
                <table class="table table-responsive">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                      <tr>
                        <td>futur sous catégorie</td>
                        <td><a href="#">Accéder</a> | <a href="#">Modifier</a></td>
                      </tr>
                      <tr>
                        <td>futur sous catégorie</td>
                        <td><a href="#">Accéder</a> | <a href="#">Modifier</a></td>
                      </tr>
                      <tr>
                        <td>futur sous catégorie</td>
                        <td><a href="#">Accéder</a> | <a href="#">Modifier</a></td>
                      </tr>

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
