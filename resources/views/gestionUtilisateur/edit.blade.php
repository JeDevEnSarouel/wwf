@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h1>Edit {{ $user->name }}</h1>

          <!-- if there are creation errors, they will show here -->
          {{ HTML::ul($errors->all()) }}

          {{ Form::model($user, array('route' => array('gestionUtilisateur.update', $user->id), 'method' => 'PUT')) }}

            <div class="form-group">
              {{ Form::label('name', 'Name') }}
              {{ Form::text('name', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('email', 'Email') }}
              {{ Form::email('email', null, array('class' => 'form-control')) }}
            </div>
            <div class="form-group">
              {{ Form::label('type', 'role') }}
              {{ Form::select('type', array('user' => 'user', 'author' => 'author', 'admin' => 'admin'), null, array('class' => 'form-control')) }}
            </div>
            {{ Form::submit('Modifier', array('class' => 'btn btn-primary')) }}

          {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
