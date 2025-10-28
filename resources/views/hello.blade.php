@extends('layouts.default')

@section('title','Hello')

@section('content')
    <h1 class="text-success">
        Hello, you are in SCAP
        @if(auth()->check())
        Logado {{ auth()->user() }}
        @endif
    </h1>

    <form action="{{ route('login.logout') }}" method="POST">
        @csrf
        <button type="submit" class="btn">logout</button>
    </form>
@endsection
