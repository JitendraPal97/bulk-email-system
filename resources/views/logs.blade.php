@extends('layouts.app')

@section('content')

<h2>Email Logs</h2>

<table class="table table-bordered">
<tr>
    <th>Email</th>
    <th>Status</th>
    <th>Campaign</th>
    <th>Time</th>
</tr>

@foreach($logs as $log)
<tr>
    <td>{{ $log->email }}</td>
    <td>
        @if($log->status == 'sent')
            <span class="text-success">Sent</span>
        @else
            <span class="text-danger">Failed</span>
        @endif
    </td>
    <td>{{ $log->campaign_id }}</td>
    <td>{{ $log->created_at }}</td>
</tr>
@endforeach

</table>

@endsection