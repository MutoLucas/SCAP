@extends('layouts.default')

@section('title' . 'SCAP - Acrescentaveis')

@section('content')
    <div class="container mt-4">

        <div class="accordion" id="accordionPanelsStayOpenExample">

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseOne">
                        Códigos de Falha
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                    <div class="accordion-body">

                        <div class="container">

                            <livewire:components.addable.fal-cod.main-table/>

                        </div>

                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseTwo">
                        Componentes
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">

                    <div class="accordion-body">

                        <livewire:components.addable.component.main-table/>

                    </div>

                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapseThree">
                        Equipamentos
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">

                    <div class="accordion-body">

                        <livewire:components.addable.equipamento.main-table/>

                    </div>

                </div>
            </div>

        </div>

    </div>
@endsection
