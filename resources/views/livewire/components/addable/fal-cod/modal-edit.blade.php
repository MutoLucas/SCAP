<div>
    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editFal{{ $falCodId }}">
        <i class="bi bi-info-circle"></i>
    </button>

    <div class="modal fade" id="editFal{{ $falCodId }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Código de Falha</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <span class="d-block text-start text-success fw-bold">
                        Código de Falha: <span class="text-muted text-success">{{ $this->fal['Código das Falhas'] }} -
                            {{ $this->fal['Grupo de Código'] }}</span>
                    </span>


                    @if (isset($message[$falCodId]['message']))
                        <div class="alert alert-{{ $message[$falCodId]['severity'] }} alert-dismissible fade show"
                            role="alert">
                            <strong>
                                @if (isset($message[$falCodId]['icon']))
                                    <i class="{{ $message[$falCodId]['icon'] }}"></i>
                                @endif
                                {{ $message[$falCodId]['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">

                        <div class="mt-3">
                            <label class="form-label d-block text-start">Grupo de Código</label>
                            <select class="form-select border-primary" wire:model="group">
                                <option value="">Grupo de Código...</option>
                                @foreach ($this->groupCods as $groupCod)
                                    <option value="{{ $groupCod['Grupo de Código'] }}">
                                        {{ $groupCod['Grupo de Código'] }}</option>
                                @endforeach
                            </select>
                            @error('group')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="form-label d-block text-start">Código de Falha</label>
                            <input type="text" class="form-control border-primary" placeholder="Código de Falha"
                                wire:model="falCod">
                            @error('falCod')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" wire:click="updateFal">Salvar Alterações</button>
                </div>

            </div>

        </div>

    </div>
</div>
