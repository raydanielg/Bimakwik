@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1>Service Provider Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}. Process claims and service requests.</p>
</div>
@endsection
