<div>
    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editCause{{ $causeId }}">
        <i class="bi bi-info-circle"></i>
    </button>

    <div class="modal fade" id="editCause{{ $causeId }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>

        <div class="modal-dialog modal-lg">

            <div class="modal-content">

                <div class="modal-header bg-dark text-white">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Causa Aparente</h1>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    <span class="d-block text-start text-success fw-bold">
                        Causa Aparente: <span class="text-muted text-success">{{ $this->cause->CausaAparente }}</span>
                    </span>

                    @if (isset($message[$causeId]['message']))
                        <div class="alert alert-{{ $message[$causeId]['severity'] }} alert-dismissible fade show"
                            role="alert">
                            <strong>
                                @if (isset($message[$causeId]['icon']))
                                    <i class="{{ $message[$causeId]['icon'] }}"></i>
                                @endif
                                {{ $message[$causeId]['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="container">

                        <div class="mt-3">
                            <label class="d-block text-start form-label">Código Da Falha</label>
                            <select class="form-select" wire:model="falCod">
                                <option value="">Código Da Falha...</option>
                                @foreach ($this->falCods as $falCod)
                                    <option value="{{ $falCod['Código das Falhas'] }}">{{ $falCod['Código das Falhas'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('falCod')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="d-block text-start form-label">Causa Aparente</label>
                            <input type="text" class="form-control" placeholder="Causa Aparente" wire:model="causaAparente">
                            @error('causaAparente')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" wire:click="updateCause">Salvar Alterações</button>
                </div>

            </div>

        </div>

    </div>
</div>
