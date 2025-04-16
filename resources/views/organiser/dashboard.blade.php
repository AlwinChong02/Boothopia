@extends('layouts.app')

@section('title', 'Organiser Dashboard')

@section('content')
    <h1>Organiser Dashboard</h1>
    <p>Welcome, {{$user->name}}!</p>
    <p>Your email is {{$user->email}}.</p>
@endsection