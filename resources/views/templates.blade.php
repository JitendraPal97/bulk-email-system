@extends('layouts.app')

@section('content')

<h2>Create Template</h2>

<form method="POST" action="/save-template">
@csrf

<input type="text" name="subject" class="form-control mb-2" placeholder="Subject">

<textarea name="body" class="form-control mb-2" rows="5"></textarea>

<button class="btn btn-success">Save</button>

</form>


<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Subject</th>
    <th>Action</th>
</tr>

@foreach($templates as $t)
<tr>
    <td>{{ $t->id }}</td>
    <td>{{ $t->subject }}</td>
    <td>
        <a href="/template/edit/{{ $t->id }}" class="btn btn-sm btn-warning">Edit</a>
    </td>
</tr>
@endforeach

</table>
@endsection