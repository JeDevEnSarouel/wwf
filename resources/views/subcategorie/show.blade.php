@extends('layouts.app')

@section('content')
<div class="container">
  @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sous catégorie {{ $subcategorie->titre }}</div>
                <a href="{{route('categorie.show', $subcategorie->categorie_id)}}">Retour</a>

                <table class="table table-responsive">
        					<thead>
        						<tr>
                      <th>User</th>
                      <th colspan="2">Message</th>
                      @if (Auth::user()->type == 'admin' || Auth::user()->type == 'modo' )
                      <th>Action</th>
                      @endif
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($subcategorie->messages as $message)
                      <tr>

                        <td>{{ $message->user->name }}</td>
                        <td colspan="2">{{ $message->text }}</td>
                        @if (Auth::user()->type == 'admin' || Auth::user()->type == 'modo' )
                            <td><a href="{{route('message.edit', $message->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'message/' . $message->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                            {{ Form::close() }}
                        </td>
                        @endif

                      </tr>
                        @foreach($message->reponses as $reponse)
                        <tr>
                          <td></td>
                          <td>{{ $reponse->user->name }}</td>
                          <td>{{ $reponse->text }}</td>
                          @if (Auth::user()->type == 'admin' || Auth::user()->type == 'modo' )
                          <td><a href="{{route('reponse.edit', $reponse->id)}}" class="btn btn-warning">Modifier</a>
                              {{ Form::open(array('url' => 'reponse/' . $reponse->id, 'class' => 'pull-right')) }}
                                  {{ Form::hidden('_method', 'DELETE') }}
                                  {{ Form::submit('Supprimer', array('class' => 'btn btn-danger')) }}
                              {{ Form::close() }}
                          </td>
                          @endif
                        </tr>
                        @endforeach
                      <tr>
                        <td colspan="4">
                          {{ HTML::ul($errors->all()) }}

                            {{ Form::open(array('url' => '/reponse/validate')) }}

                            <div class="form-group">
                              {{ Form::label('text', 'Envoyer une réponse') }}
                              {{ Form::text('text', Input::old('text'), array('class' => 'form-control')) }}
                            </div>

                            {{ Form::hidden('sub_categorie_id', $id) }}
                            {{ Form::hidden('message_id', $message->id) }}


                            {{ Form::submit('Envoyer', array('class' => 'btn btn-primary')) }}

                          {{ Form::close() }}
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
