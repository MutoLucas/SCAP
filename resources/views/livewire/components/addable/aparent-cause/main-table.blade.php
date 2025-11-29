<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        <livewire:components.addable.aparent-cause.form-create />

        <div class="d-flex justify-content-between align-items-end p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Equipamentos
            </div>

            <div class="">

                <div class="d-flex justify-content-between gap-1">

                    <select class="form-select form-select-sm" wire:model.lazy="filterFalCod">
                        <option value="">Codigo Falha...</option>
                        @foreach ($this->falCods as $falCod)
                            <option value="{{ $falCod['Código das Falhas'] }}">{{ $falCod['Código das Falhas'] }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Causa Aparente..."
                        wire:model.lazy="filterName">

                    <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
            </div>
        </div>

        @if ($this->aparentCauses)
            <div class="table-responsive">
                <table class="table text-center table-bordered table-striped table-hover caption-top">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Codigo Falha</th>
                            <th scope="col">Causa Aparente</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>

                    <tbody class="table-success">
                        @foreach ($this->aparentCauses as $aparentCause)
                            <tr wire:key="{{ $aparentCause->Id }}">
                                <td>{{ $aparentCause->CodigoFalha }}</td>
                                <td>{{ $aparentCause->CausaAparente }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <livewire:components.addable.aparent-cause.modal-edit
                                        wire:key="{{ $aparentCause->Id }}" :causeId="$aparentCause->Id" />

                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        wire:key="{{ $aparentCause->Id }}" data-bs-target="#deleteCause"
                                        wire:click="selectCause({{ $aparentCause->Id }})">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $this->aparentCauses->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
                </div>
            </div>
        @else
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-0">Nenhuma Causa Aparente registrada</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteCause" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteCause" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @if (isset($messageDelete['message']))
                        <div class="alert alert-{{ $messageDelete['severity'] }} alert-dismissible fade show"
                            role="alert">
                            <strong>
                                @if (isset($messageDelete['icon']))
                                    <i class="{{ $messageDelete['icon'] }}"></i>
                                @endif
                                {{ $messageDelete['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($causeSelected)
                        <p class="mb-0 fs-6">
                            Tem certeza que deseja deletar a Causa Aparente:
                        </p>
                        <div class="mt-3 p-3 bg-light rounded border">
                            <div class="text-center">
                                <strong>{{ $causeSelected->CausaAparente }}</strong><br>
                                <span class="text-muted">{{ $causeSelected->CodigoFalha }}</span>
                            </div>
                        </div>
                        <p class="text-danger mt-3 mb-0 fw-semibold">Esta ação não poderá ser desfeita.</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>

                    <button type="button" class="btn btn-danger" wire:click="deleteCause">
                        <i class="bi bi-trash-fill me-1"></i> Deletar
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
