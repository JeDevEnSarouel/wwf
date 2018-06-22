@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestion utilisateur</div>

                <table class="table table-responsive">
        					<thead>
        						<tr>
        							<th>Pseudo</th>
        							<th>Rôle</th>
        							<th>Modifier</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->type}}</td>
                        <td>
                          <a href="{{route('gestionUtilisateur.edit', $user->id)}}">modifier</a>
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
