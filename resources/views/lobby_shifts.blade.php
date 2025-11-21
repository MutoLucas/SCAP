@extends('layouts.default')

@section('title','SCAP - Turnos')

@section('content')
<div class="container d-flex flex-column align-items-start mt-4">
    <h1 class="fw-bold">Turnos de Ocorrência</h1>
    <small class="fs-5">Gerenciar Turnos de Ocorrência.</small>
</div>

<div class="container d-flex gap-3 mt-3">

    <livewire:components.shift.form-create/>

</div>

@endsection
