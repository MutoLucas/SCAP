<div class="container col-4">
    <form class="container" wire:submit="storeOcorrenciaTurno">
        <div class="d-flex justify-content-center border border-secondary bg bg-dark text-light p-3 rounded-top">
            <h3 class="fw-bold fs-4">Formulário de Criação</h3>
        </div>

        <div class="border-start border-end border-bottom border-secondary p-2">

            @if(isset($message['message']))
            <div class="alert alert-{{ $message['severity'] }} alert-dismissible fade show" role="alert">
                <strong><i class="{{ $message['icon'] }}"></i></strong> {{ $message['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-2">
                <label class="form-label">Processo</label>
                <select class="form-select form-select-sm border-primary" wire:model.lazy="processo">
                    <option value="">Processo...</option>
                    @foreach ($this->processos as $processo)
                    <option value="{{ $processo->Processo }}">{{ $processo->Processo }} - {{ $processo->Descrição }}</option>
                    @endforeach
                </select>
                @error('processo')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">Sistema</label>
                @if($this->sistemas)
                <select class="form-select form-select-sm border-primary" wire:model.lazy="sistema">
                    <option value="">Sistema...</option>
                    @foreach ($this->sistemas as $sistema)
                    <option value="{{ $sistema->Sistema }}">{{ $sistema->Sistema }}</option>
                    @endforeach
                </select>
                @else
                <div>
                    <small class="text-danger fw-bold">Selecione um processo</small>
                </div>
                @endif
                @error('sistema')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">Equipamento</label>
                @if($this->equipamentos)
                <select class="form-select form-select-sm border-primary" wire:model="equipamento">
                    <option value="">Equipamento...</option>
                    @foreach ($this->equipamentos as $equipamento)
                    <option value="{{ $equipamento->Equipamento }}">{{ $equipamento->Equipamento }}</option>
                    @endforeach
                </select>
                @else
                <div>
                    <small class="text-danger fw-bold">Selecione um Processo e um Sistema</small>
                </div>
                @endif
                @error('equipamento')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label for="" class="form-label">Data</label>
                <input type="datetime-local" class="form-control form-control-sm border-primary" wire:model="data">
                @error('data')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">Turno</label>
                <select class="form-select form-select-sm border-primary" wire:model="turno">
                    <option value="">Turno...</option>
                    @foreach ($this->turnos as $turno)
                    <option value="{{ $turno->Turno }}">{{ $turno->Turno }} - {{ $turno->Horario }}</option>
                    @endforeach
                </select>
                @error('turno')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label class="form-label">Operador</label>
                <div class="input-group">
                    <select class="form-select form-select-sm border-primary" wire:model="operador">
                        <option value="">Operador...</option>
                        @foreach ($this->operadores as $operador)
                        <option value="{{ $operador->Login }}">{{ $operador->Nome }} - {{ $operador->Login }}</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control form-control-sm border-primary" placeholder="Buscar.." wire:model.lazy="searchOperador">
                </div>
                @error('operador')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-2">
                <label for="" class="form-label">Descrição</label>
                <textarea class="form-control border-primary" placeholder="Descrição..." wire:model="descricao"></textarea>
                @error('descricao')
                <small class="text-danger fw-bold">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success w-100" type="submit">
                Cadastrar
                <span class="block spinner-border spinner-border-sm" wire:loading></span>
            </button>
        </div>
    </form>
</div>
