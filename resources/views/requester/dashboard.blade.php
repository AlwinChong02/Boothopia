@extends('layouts.app')

@section('title', 'Requester Dashboard')

@section('content')
    <h1>Requester Dashboard</h1>
    <p>Welcome, {{$user->name}}!</p>
    <p>Your email is {{$user->email}}.</p>
@endsection