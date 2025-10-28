@extends('layouts.default')

@section('title','SCAP - Bem-Vindo')

@section('content')
    <div class="container d-flex flex-column align-items-center mt-4">
        <h1 class="fw-bold">Seja Bem-Vindo ao SCAP</h1>
        <small class="fs-5">Sistema de Controle de Apropriação de Paradas</small>
    </div>

    <livewire:components.lobby.main-table/>
@endsection
