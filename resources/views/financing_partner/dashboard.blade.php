@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <h1>Financing Partner Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}. Monitor premium financing loans and repayments.</p>
</div>
@endsection
