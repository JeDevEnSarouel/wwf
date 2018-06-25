@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Message</div>
                <a href="{{ route('message.create') }}">Créer un nouveau message</a>
                <table class="table" style="width:100%">
        					<thead>
        						<tr>
        							<th>Nom</th>
                      <th>Action</th>
        						</tr>

        					</thead>

                  <tbody>
                    @foreach($messages as $message)
                      <tr>
                        <td>{{$message->text}}</td>
                        <td>
                            <span class="glyphicon glyphicon-pencil" ></span>
                            <a href="{{route('message.edit', $message->id)}}" class="btn btn-warning">Modifier</a>
                            {{ Form::open(array('url' => 'message/' . $message->id, 'class' => 'pull-right')) }}
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
