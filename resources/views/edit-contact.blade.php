@extends('layouts.app')

@section('content')

<h2>Edit Contact</h2>

<form method="POST" action="/contact/update/{{ $contact->id }}">
@csrf

<input type="text" name="name" class="form-control mb-2" value="{{ $contact->name }}">

<input type="email" name="email" class="form-control mb-2" value="{{ $contact->email }}">

<button class="btn btn-success">Update</button>

</form>

@endsection