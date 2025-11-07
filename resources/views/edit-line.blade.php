@extends('layouts.default')

@section('title','SCAP - Editar Parada')

@section('content')
    <div class="container d-flex flex-column align-items-start mt-4">
        <h1 class="fw-bold">Editar Parada: {{ $lineId }}</h1>
        <small class="fs-5">Edição direta no banco de dados</small>
    </div>

    <livewire:components.parada.edit-line :lineId="$lineId"/>
@endsection
