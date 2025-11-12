@extends('layouts.default')

@section('title','SCAP - Editar Parada')

@section('content')
    <div class="container d-flex flex-column align-items-start mt-4">
        @if(auth()->check())
        <h1 class="fw-bold">Editar Parada: {{ $lineId }}</h1>
        <small class="fs-5">Edição direta no banco de dados</small>
        @else
        <h1 class="fw-bold">Verificar Parada: {{ $lineId }}</h1>
        <small class="fs-5">Verificação dos dados armazenados no banco de dados</small>
        @endif
    </div>

    <livewire:components.parada.edit-line :lineId="$lineId"/>
@endsection
