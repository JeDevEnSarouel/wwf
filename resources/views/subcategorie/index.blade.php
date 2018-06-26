@extends('layouts.app')

<!DOCTYPE html>
<html>
<head>
    <title>Sous-Catégories</title>
</head>
<body>
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

<h1>All the Nerds</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Titre</td>
            <td>Categorie ID</td>
            <td>Timestamps</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($subcategorie as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->titre }}</td>
            <td>{{ $value->categorie_id }}</td>
            <td>{{ $value->timestamps }}</td>

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('subcategorie/' . $value->id) }}">Show this Nerd</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('subcategorie/' . $value->id . '/edit') }}">Edit this Nerd</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>
