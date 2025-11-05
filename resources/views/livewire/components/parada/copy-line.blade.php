<div class="container mt-4 p-2">
    {{-- @foreach ($this->codigoFalhas as $falCod)
        <p>{{ $falCod }}</p>
    @endforeach --}}
    <div class="w-full d-flex justify-around gap-3">

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Operação</h2>
            </div>

            <div class="d-flex flex-column justify-center">

                <div>
                    <label class="form-label">Tag Gerador</label>
                    <select class="form-select form-select-sm" wire:model="tagGerador">
                        <option value="">Selecione...</option>
                        @foreach ($this->equipamentos as $equipamento)
                        <option value="{{ $equipamento->Equipamento }}">{{ $equipamento->Equipamento }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Tipo de Código</label>
                    <select wire:model="tipCod" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->tipoCodigos as $tipCod)
                            <option value="{{ $tipCod->{"Tipo de Código"} }}">{{ $tipCod->{"Tipo de Código"} }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Grupo de Código</label>
                    <select wire:model="grupCod" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->grupoCodigos as $grupCod)
                            <option value="{{ $grupCod->{"Grupo de Código"} }}">{{ $grupCod->{"Grupo de Código"} }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Código de Falha</label>
                    <select wire:model="falCod" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->codigoFalhas as $falCod)
                        <option value="{{ $falCod->{"Código das Falhas"} }}">{{ $falCod->{"Código das Falhas"} }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Causa Aparente</label>
                    <select wire:model="causaAparente" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->causasAparentes as $causaAparente)
                        <option value="{{ $causaAparente->CausaAparente }}">{{ $causaAparente->CausaAparente }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="form-label">Componente</label>
                    <select wire:model="componente" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->componentes as $componente)
                        <option value="{{ $componente->Componente }}">{{ $componente->Componente }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Automático</h2>
            </div>

            <div class="">


            </div>
        </div>

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Manutanção</h2>
            </div>

            <div class="">



            </div>
        </div>

    </div>

    <div class="w-full mt-3">

        <div class="border border-light-subtle rounded-2 w-full p-3 shadow-lg">
            <div class="w-full">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Observação</h2>
            </div>

            <div class="">

                <textarea wire:model="observacao" cols="30" rows="6" class="form-control"></textarea>

            </div>
        </div>

    </div>

</div>
