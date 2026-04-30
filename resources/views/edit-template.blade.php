@extends('layouts.app')

@section('content')

<h2>Edit Template</h2>


</form>

<form method="POST" action="/template/update/{{ $template->id }}">
@csrf

<input name="subject" class="form-control mb-2" placeholder="Subject" value="{{ $template->subject }}"><br>

<textarea class="form-control mb-2" rows="5" name="body">{{ $template->body }}</textarea><br>

<button class="btn btn-success">Update</button>
</form>

@endsection