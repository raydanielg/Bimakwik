@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1>Agent Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}. Here you can manage your sales and commissions.</p>
</div>
@endsection
