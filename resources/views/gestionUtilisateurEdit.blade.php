@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestion utilisateur</div>




                <form action="{{route('gestionutilisateurupdate', $user->id)}}" method="post">
                  @csrf
                  @method('put')
                  <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" name="title" id="title" class="form-control" value='{{$user->name}}'>
                  </div>
                  <div class="form-group">
                    <label for="content">Email</label>
                    <input type="text" name="title" id="title" class="form-control" value='{{$user->email}}'>
                  </div>
                  <div class="form-group">
                    <label for="content">Role</label>
                    <input type="text" name="title" id="title" class="form-control" value='{{$user->type}}'>
                    <select>
                      <option value="user" @if ($user->type === 'user') selected @endif>user</option>
                      <option value="user" @if ($user->type === 'author') selected @endif>author</option>
                      <option value="user" @if ($user->type === 'admin') selected @endif>admin</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-outline-info">Modifier</button>
                  </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
