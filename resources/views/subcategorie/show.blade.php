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
                      <th>User</th>
                      <th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($subcategorie->messages as $message)
                      <tr>

                        <td>{{ $message->user->name }}</td>
                        <td>{{ $message->text }}</td>
                        <td><a href="{{route('message.edit', $message->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'message/' . $message->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                            <a href="" class="btn btn-success">Répondre</a>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>

                <hr>

                <!-- if there are creation errors, they will show here -->
                {{ HTML::ul($errors->all()) }}

                  {{ Form::open(array('url' => '/message/validate')) }}

                  <div class="form-group">
                    {{ Form::label('text', 'Envoyer votre message') }}
                    {{ Form::textarea('text', Input::old('text'), array('class' => 'form-control')) }}
                  </div>

                  {{ Form::hidden('sub_categorie_id', $id) }}


                  {{ Form::submit('Envoyer', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
