@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h1>Créer un message</h1>

          <!-- if there are creation errors, they will show here -->
          {{ HTML::ul($errors->all()) }}

            {{ Form::open(array('url' => 'message')) }}

            <div class="form-group">
              {{ Form::label('text', 'Message') }}
              {{ Form::text('text', Input::old('text'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Créer', array('class' => 'btn btn-primary')) }}

          {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
