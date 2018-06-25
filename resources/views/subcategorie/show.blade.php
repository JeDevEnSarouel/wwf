@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sous catégorie {{ $subcategorie->titre }}</div>
                <a href="{{route('categorie.show', $subcategorie->categorie_id)}}">Retour</a>

                <table class="table table-responsive">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                      <tr>
                        <td>futur message</td>
                      </tr>
                      <tr>
                        <td>futur message</td>
                      </tr>
                      <tr>
                        <td>futur message</td>
                      </tr>

                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
