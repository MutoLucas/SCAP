@extends('layouts.default')

@section('title','Usuarios - lobby')

@section('content')
    <div class="container d-flex flex-column align-items-start mt-4">
        <h1 class="fw-bold">Criação de Usuários</h1>
        <small class="fs-5">Criar e Editar Usuários do sistema</small>
    </div>

    <div class="container d-flex gap-3 mt-3">
        <livewire:components.users.create>
    </div>
@endsection
