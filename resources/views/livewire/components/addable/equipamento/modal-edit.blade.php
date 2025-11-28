<div>
    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editEquip{{ $equipamentId }}">
        <i class="bi bi-info-circle"></i>
    </button>

    <div class="modal fade" id="editEquip{{ $equipamentId }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Equipamento</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <span class="d-block text-start text-success fw-bold">
                        Equipamento: <span class="text-muted text-success">{{ $this->equipament->Equipamento }}</span>
                    </span>

                    @if (isset($message[$equipamentId]['message']))
                        <div class="alert alert-{{ $message[$equipamentId]['severity'] }} alert-dismissible fade show"
                            role="alert">
                            <strong>
                                @if (isset($message[$equipamentId]['icon']))
                                    <i class="{{ $message[$equipamentId]['icon'] }}"></i>
                                @endif
                                {{ $message[$equipamentId]['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">

                        <div class="container d-flex jystify-content-between gap-2">

                            <div class="col-6 mt-3">
                                <label class="d-block text-start form-label">Processo</label>
                                <select class="form-select" wire:model.lazy="processo">
                                    <option value="">Processo...</option>
                                    @foreach ($this->processos as $processo)
                                        <option value="{{ $processo->Processo }}">{{ $processo->Processo }}</option>
                                    @endforeach
                                </select>
                                @error('processo')
                                    <small class="d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <label class="d-block text-start form-label">Sistema</label>
                                <select class="form-select" wire:model="sistema">
                                    @if ($this->sistemas)
                                        <option value="">sistema...</option>
                                        @foreach ($this->sistemas as $sistema)
                                            <option value="{{ $sistema->Sistema }}">{{ $sistema->Sistema }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">Selecione um Processo</option>
                                    @endif
                                </select>
                                @error('sistema')
                                    <small class="d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="container d-flex jystify-content-between gap-2">

                            <div class="col-6 mt-3">
                                <label class="d-block text-start form-label">Equipamento</label>
                                <input type="text" class="form-control" placeholder="Equipamento"
                                    wire:model="equipamento">
                                @error('equipamento')
                                    <small class="d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-6 mt-3">
                                <label class="d-block text-start form-label">Grupo de Equipamento</label>
                                <select class="form-select" wire:model="group">
                                    <option value="">Grupo...</option>
                                    @foreach ($this->equipGroups as $equipGroup)
                                        <option value="{{ $equipGroup['Grupo de Equipamentos'] }}">
                                            {{ $equipGroup['Grupo de Equipamentos'] }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('group')
                                    <small class="d-block text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" wire:click="updateEquipament">Salvar
                        Alterações</button>
                </div>

            </div>

        </div>

    </div>
</div>
