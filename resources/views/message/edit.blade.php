@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h1>Modifier le message {{ $message->texte }}</h1>

          <!-- if there are creation errors, they will show here -->
          {{ HTML::ul($errors->all()) }}

          {{ Form::model($message, array('route' => array('message.update', $message->id), 'method' => 'PUT')) }}

            <div class="form-group">
              {{ Form::label('text', 'Text') }}
              {{ Form::text('text', null, array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Modifier', array('class' => 'btn btn-primary')) }}

          {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
