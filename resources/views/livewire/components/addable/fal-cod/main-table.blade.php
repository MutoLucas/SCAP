<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        <livewire:components.addable.falCod.form-create />

        @if (isset($message['message']))
            <div class="alert alert-{{ $message['severity'] }} alert-dismissible fade show" role="alert">
                <strong><i class="{{ $message['icon'] }}"></i> {{ $message['message'] }}</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-end p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Códigos das Falhas
            </div>

            <div class="">

                <div class="d-flex justify-content-between gap-1">

                    <select class="form-select form-select-sm" wire:model.lazy="filterGroup">
                        <option value="">Grupo...</option>
                        @foreach ($this->groups as $group)
                            <option value="{{ $group['Grupo de Código'] }}">{{ $group['Grupo de Código'] }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Código das Falhas"
                        wire:model.lazy="filterName">

                    <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>

                    <button type="button" class="btn btn-outline-success" wire:click="exportToExcel">
                        <i class="bi bi-file-earmark-spreadsheet-fill" wire:loading.class="visually-hidden"></i>
                        <div class="spinner-grow spinner-grow-sm text-success" role="status" wire:loading>
                        </div>
                    </button>
                </div>
            </div>
        </div>

        @if ($this->falCods)
            <div class="table-responsive">
                <table class="table text-center table-bordered table-striped table-hover caption-top">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Grupo de Código</th>
                            <th scope="col">Código das Falhas</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>

                    <tbody class="table-success">
                        @foreach ($this->falCods as $fal)
                            <tr wire:key="{{ $fal->id }}">
                                <td>{{ $fal['Grupo de Código'] }}</td>
                                <td>{{ $fal['Código das Falhas'] }}</td>
                                <td class="d-flex justify-content-center gap-1">
                                    <livewire:components.addable.fal-cod.modal-edit wire:key="{{ $fal->id }}"
                                        :falCodId="$fal->id" />
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteFalCod" wire:key="{{ $fal->id }}"
                                        wire:click="selectFalCod({{ $fal->id }})">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $this->falCods->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
                </div>
            </div>
        @else
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-0">Nenhum Código de Falha registrado</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteFalCod" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteFalCod" aria-hidden="true" wire:ignore.self>
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

                    @if ($falCodSelected)
                        <p class="mb-0 fs-6">
                            Tem certeza que deseja deletar o Código de Falha:
                        </p>
                        <div class="mt-3 p-3 bg-light rounded border">
                            <div class="text-center">
                                <strong>{{ $falCodSelected['Código das Falhas'] }}</strong><br>
                                <span class="text-muted">{{ $falCodSelected['Grupo de Código'] }}</span>
                            </div>
                        </div>
                        <p class="text-danger mt-3 mb-0 fw-semibold">Esta ação não poderá ser desfeita.</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>

                    <button type="button" class="btn btn-danger" wire:click="deleteFalCod">
                        <i class="bi bi-trash-fill me-1"></i> Deletar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
