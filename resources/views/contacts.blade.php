@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-end mb-3">
    <a href="/contacts/download-csv-format" class="btn btn-info">
        Download CSV Format
    </a>
</div>
<h2 class="mb-4">Contacts</h2>

<form class="mb-3">
    <input type="file" class="form-control mb-2">
    <button class="btn btn-primary">Upload</button>
</form>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($contacts as $c)
    <tr>
        <td>{{ $c->name }}</td>
        <td>{{ $c->email }}</td>
        <td><a href="/contact/delete/{{ $c->id }}" class="btn btn-sm btn-danger" onclick="return confirm('Delete this contact?')">Delete</a> &nbsp;<a href="/contact/edit/{{ $c->id }}" class="btn btn-sm btn-warning">Edit</a></td>
    </tr>
    @endforeach
</table>


@endsection