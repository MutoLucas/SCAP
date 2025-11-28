<div>
    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editComp{{ $compId }}">
        <i class="bi bi-info-circle"></i>
    </button>

    <div class="modal fade" id="editComp{{ $compId }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Componente</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <span class="d-block text-start text-success fw-bold">
                        Componente: <span class="text-muted text-success">{{ $this->comp->Componente }} -
                            {{ $this->comp['Grupo de Equipamentos'] }}</span>
                    </span>


                    @if (isset($message[$compId]['message']))
                        <div class="alert alert-{{ $message[$compId]['severity'] }} alert-dismissible fade show" role="alert">
                            <strong>
                                @if (isset($message[$compId]['icon']))
                                    <i class="{{ $message[$compId]['icon'] }}"></i>
                                @endif
                                {{ $message[$compId]['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">

                        <div class="mt-3">
                            <label class="form-label d-block text-start">Grupo de Equipamento</label>
                            <select class="form-select border-primary" wire:model="group">
                                <option value="">Grupo de Equipamento...</option>
                                @foreach ($this->groups as $group)
                                    <option value="{{ $group['Grupo de Equipamentos'] }}">
                                        {{ $group['Grupo de Equipamentos'] }}</option>
                                @endforeach
                            </select>
                            @error('group')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="form-label d-block text-start">Componente</label>
                            <input type="text" class="form-control border-primary" placeholder="Código de Falha"
                                wire:model="compName">
                            @error('compName')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>


                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" wire:click="updateComp">Salvar Alterações</button>
                </div>

            </div>

        </div>

    </div>
</div>
