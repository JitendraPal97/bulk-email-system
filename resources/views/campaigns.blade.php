@extends('layouts.app')

@section('content')

<h2>Create Campaign</h2>

<form method="POST" action="/create-campaign">
@csrf

<select name="template_id" class="form-control mb-2">
@foreach($templates as $t)
<option value="{{ $t->id }}">{{ $t->subject }}</option>
@endforeach
</select>

<button class="btn btn-primary">Create</button>

</form>

<h3 class="mt-4">Campaign List</h3>
<table class="table table-bordered mt-3">
<!-- <tr><th>Name</th><th>Email</th></tr> -->
 @foreach($campaigns as $c)
 <tr><th>Campaign {{ $c->id }}</th><th><a href="/send-campaign/{{ $c->id }}" class="btn btn-sm btn-success">Send</a></th></tr> 

    
    @endforeach

<div class="mb-3">
    <span class="text-success">Sent: {{ $sent ?? 0 }}</span>
    <span class="text-danger ms-3">Failed: {{ $failed ?? 0 }}</span>
</div>

@endsection