<div class="container mt-4 p-2">

    <div class="w-full d-flex justify-around gap-3">

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Operação</h2>
            </div>

            <div class="d-flex flex-column justify-content-center">

                <div class="p-1">
                    <label class="form-label">Tag Gerador</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="tagGerador">
                        <option value="">Selecione...</option>
                        @foreach ($this->equipamentos as $equipamento)
                            <option value="{{ $equipamento->id }}">{{ $equipamento->Equipamento }}</option>
                        @endforeach
                    </select>
                    @error('tagGerador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Tipo de Código</label>
                    <select wire:model.lazy="tipCod" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->tipoCodigos as $tipCod)
                            <option value="{{ $tipCod->{"Tipo de Código"} }}">{{ $tipCod->{"Tipo de Código"} }}</option>
                        @endforeach
                    </select>
                    @error('tipCod')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Grupo de Código</label>
                    <select wire:model.lazy="grupCod" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->grupoCodigos as $grupCod)
                            <option value="{{ $grupCod->{"Grupo de Código"} }}">{{ $grupCod->{"Grupo de Código"} }}
                            </option>
                        @endforeach
                    </select>
                    @error('grupCod')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Código de Falha</label>
                    <select wire:model.lazy="falCod" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->codigoFalhas as $falCod)
                            <option value="{{ $falCod->{"Código das Falhas"} }}">{{ $falCod->{"Código das Falhas"} }}
                            </option>
                        @endforeach
                    </select>
                    @error('falCod')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Causa Aparente</label>
                    <select wire:model.lazy="causaAparente" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->causasAparentes as $causaAparente)
                            <option value="{{ $causaAparente->CausaAparente }}">{{ $causaAparente->CausaAparente }}
                            </option>
                        @endforeach
                    </select>
                    @error('causaAparente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Componente</label>
                    <select wire:model.lazy="componente" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->componentes as $componente)
                            <option value="{{ $componente->Componente }}">{{ $componente->Componente }}</option>
                        @endforeach
                    </select>
                    @error('componente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>
        </div>

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Automático</h2>
            </div>

            <div class="d-flex flex-column justify-content-center">

                <div class="p-1">
                    <label class="form-label">Processo</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="processo">
                        <option value="">Selecione...</option>
                        @foreach ($this->processos as $processo)
                            <option value="{{ $processo->Processo }}">{{ $processo->Processo }}</option>
                        @endforeach
                    </select>
                    @error('processo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Sistema</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="sistema">
                        <option value="">Selecione...</option>
                        @foreach ($this->sistemas as $sistema)
                            <option value="{{ $sistema->Sistema }}">{{ $sistema->Sistema }}</option>
                        @endforeach
                    </select>
                    @error('sistema')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Equipamento</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="equipamento">
                        <option value="">Selecione...</option>
                        @foreach ($this->equipamentos as $equipamento)
                            <option value="{{ $equipamento->Equipamento }}">{{ $equipamento->Equipamento }}</option>
                        @endforeach
                    </select>
                    @error('equipamento')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Inicio</label>
                    <input type="datetime-local" class="form-control border-primary" wire:model.lazy="inicio">
                    @error('Inicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Fim</label>
                    <input type="datetime-local" class="form-control border-primary" wire:model.lazy="fim">
                    @error('fim')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    {{ $this->turno }}
                    <label class="form-label">Turno</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="turno">
                        <option value="">Selecione...</option>
                        @foreach ($this->turnos as $turno)
                            <option value="{{ $turno->Turno }}">{{ $turno->Turno }} - {{ $turno->Horario }}</option>
                        @endforeach
                    </select>
                    @error('turno')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="p-1">
                    <label class="form-label">Operador</label>
                    <select class="form-select form-select-sm border-primary" wire:model.lazy="operador">
                        <option value="">Selecione...</option>
                        @foreach ($this->operadores as $operador)
                            <option value="{{ $operador->Login }}">{{ $operador->Nome }}</option>
                        @endforeach
                    </select>
                    @error('operador')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

            </div>`

        </div>
    </div>

    <div class="w-full mt-3">

        <div class="border border-light-subtle rounded-2 w-full p-3 shadow-lg">
            <div class="w-full">
                <small class="text-success">Editar</small>
                <h2 class="fs-5">Observação</h2>
                @error('observacao')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="">

                <textarea wire:model="observacao" cols="30" rows="6" class="form-control"></textarea>

            </div>
        </div>

    </div>

    <div class="w-full mt-2 d-flex justify-content-end">
        <button class="btn btn-outline-success" type="button" wire:click="storeNewParada"><i
                class="bi bi-upload"></i> Salvar</button>
    </div>

</div>
