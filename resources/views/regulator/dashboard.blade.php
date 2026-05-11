@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1>Regulator Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}. Access industry data and compliance reports.</p>
</div>
@endsection
