@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sous catégorie {{ $subcategorie->titre }}</div>
                <a href="{{route('categorie.show', $subcategorie->categorie_id)}}">Retour</a>
                <a href="{{ route('message.customcreate', $subcategorie->id) }}">Créer un message</a>

                <table class="table table-responsive">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($subcategorie->messages as $message)
                      <tr>

                        <td>{{ $message->text }}</td>
                        <td><a href="{{route('message.edit', $message->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'message/' . $message->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                      </tr>
                    @endforeach

                  </tbod
            </div>
        </div>
    </div>
</div>
@endsection
