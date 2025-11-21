<div>
    <button class="btn btn-sm btn-outline-primary rounded-circle shadow-sm" data-bs-toggle="modal"
        data-bs-target="#modalEdit{{ $ocorrenciaId }}">
        <i class="bi bi-info-circle"></i>
    </button>

    <div class="modal fade" id="modalEdit{{ $ocorrenciaId }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Ocorrência</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <small class="d-block text-success text-start fw-bold">Ocorrência:
                        {{ $this->ocorrencia->Id }}</small>


                    @if (isset($message['message']))
                        <div class="alert alert-{{ $message['severity'] }} alert-dismissible fade show" role="alert">
                            <strong><i class="{{ $message['icon'] }}"></i></strong> {{ $message['message'] }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container d-flex justify-between mb-2 gap-2">

                        <div class="col-6">
                            <label class="d-block text-start form-label">Processo</label>
                            <select class="form-select form-select-sm border-primary" wire:model.lazy="processo">
                                <option value="">Processo...</option>
                                @foreach ($this->processos as $processo)
                                    <option value="{{ $processo->Processo }}">{{ $processo->Processo }} -
                                        {{ $processo->Descrição }}</option>
                                @endforeach
                            </select>
                            @error('processo')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-6">
                            <label class="d-block text-start form-label">Sistema</label>
                            @if ($this->sistemas)
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

                    </div>

                    <div class="container d-flex justify-between mb-2 gap-2">

                        <div class="col-6">
                            <label class="d-block text-start form-label">Equipamento</label>
                            @if ($this->equipamentos)
                                <select class="form-select form-select-sm border-primary" wire:model="equipamento">
                                    <option value="">Equipamento...</option>
                                    @foreach ($this->equipamentos as $equipamento)
                                        <option value="{{ $equipamento->Equipamento }}">
                                            {{ $equipamento->Equipamento }}</option>
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

                        <div class="col-6">
                            <div class="mb-2">
                                <label for="" class="d-block text-start form-label">Data</label>
                                <input type="datetime-local" class="form-control form-control-sm border-primary"
                                    wire:model="data">
                                @error('data')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                    </div>

                    <div class="container d-flex justify-between mb-2 gap-2">

                        <div class="col-4">
                            <label class="d-block text-start form-label">Turno</label>
                            <select class="form-select form-select-sm border-primary" wire:model="turno">
                                <option value="">Turno...</option>
                                @foreach ($this->turnos as $turno)
                                    <option value="{{ $turno->Turno }}">{{ $turno->Turno }} - {{ $turno->Horario }}
                                    </option>
                                @endforeach
                            </select>
                            @error('turno')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-8">
                            <label class="d-block text-start form-label">Operador</label>
                            <div class="input-group">
                                <select class="form-select form-select-sm border-primary" wire:model="operador">
                                    <option value="">Operador...</option>
                                    @foreach ($this->operadores as $operador)
                                        <option value="{{ $operador->Login }}">{{ $operador->Nome }} -
                                            {{ $operador->Login }}</option>
                                    @endforeach
                                </select>
                                <input type="text" class="form-control form-control-sm border-primary"
                                    placeholder="Buscar.." wire:model.lazy="searchOperador">
                            </div>
                            @error('operador')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="container">
                        <div class="col-12">
                            <label for="" class="d-block text-start form-label">Descrição</label>
                            <textarea class="form-control border-primary" placeholder="Descrição..." wire:model="descricao"></textarea>
                            @error('descricao')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">fechar</button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteocorrencia{{ $this->ocorrencia->Id }}">Deletar</button>
                    <button type="button" class="btn btn-primary" wire:click="updateOcorrencia">Salvar
                        Alterações</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteocorrencia{{ $this->ocorrencia->Id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Deletar Ocorrência</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <p class="text-center fs-5">
                        Tem certeza que deseja deletar a ocorrência
                        <span class="text-success fw-bold">#{{ $this->ocorrencia->Id }}</span>?
                    </p>

                    <div class="alert alert-warning text-center py-2 mt-3">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Esta ação não pode ser desfeita.
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="deleteOcorrencia">Deletar Ocorrência</button>
                </div>
            </div>
        </div>
    </div>
</div>
