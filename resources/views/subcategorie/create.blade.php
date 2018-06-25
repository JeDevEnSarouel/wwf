@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

          <h1>Créer une sous-catégorie</h1>
          <div class="container">

            <nav class="navbar navbar-inverse">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ URL::to('subcategorie') }}">Nerd Alert</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="{{ URL::to('subcategorie') }}">View All Nerds</a></li>
                    <li><a href="{{ URL::to('subcategorie/create') }}">Create a Nerd</a>
                </ul>
            </nav>

            <h1>Create a Nerd</h1>

            <!-- if there are creation errors, they will show here -->
            {{ HTML::ul($errors->all()) }}

            {{ Form::open(array('url' => 'nerds')) }}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', Input::old('email'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('nerd_level', 'Nerd Level') }}
                    {{ Form::select('nerd_level', array('0' => 'Select a Level', '1' => 'Sees Sunlight', '2' => 'Foosball Fanatic', '3' => 'Basement Dweller'), Input::old('nerd_level'), array('class' => 'form-control')) }}
                </div>

                {{ Form::submit('Create the Nerd!', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

          </div>
        </div>
    </div>
</div>
@endsection
