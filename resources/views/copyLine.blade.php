@extends('layouts.default')

@section('title'.'SCAP - Copiar Linha')

@section('content')
    <div class="container d-flex flex-column align-items-start mt-4">
        <h1 class="fw-bold">Inserir Nova Linha</h1>
        <small class="fs-5">Inserção de nova linha apartir de uma existente</small>
    </div>

    <livewire:components.parada.copy-line :lineId="$lineId" />
@endsection
