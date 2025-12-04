<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        <livewire:components.addable.equipamento.form-create />

        @if (isset($message['message']))
            <div class="alert alert-{{ $message['severity'] }} alert-dismissible fade show" role="alert">
                <strong><i class="{{ $message['icon'] }}"></i> {{ $message['message'] }}</strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-end p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Equipamentos
            </div>

            <div class="">

                <div class="d-flex justify-content-between gap-1">

                    <select class="form-select form-select-sm" wire:model.lazy="processo">
                        <option value="">Processo...</option>
                        @foreach ($this->processos as $key)
                            <option value="{{ $key->Processo }}">{{ $key->Processo }}</option>
                        @endforeach
                    </select>

                    <select class="form-select form-select-sm" wire:model.lazy="sistema">
                        <option value="">Sistema...</option>
                        @foreach ($this->sistemas as $key)
                            <option value="{{ $key->Sistema }}">{{ $key->Sistema }}</option>
                        @endforeach
                    </select>

                    <select class="form-select form-select-sm" wire:model.lazy="group">
                        <option value="">Grupo Equipamento...</option>
                        @foreach ($this->groupEquips as $key)
                            <option value="{{ $key['Grupo de Equipamentos'] }}">{{ $key['Grupo de Equipamentos'] }}
                            </option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Equipamento..."
                        wire:model.lazy="name">

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

        @if ($this->equipaments)
            <div class="table-responsive">
                <table class="table text-center table-bordered table-striped table-hover caption-top">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Processo</th>
                            <th scope="col">Sistema</th>
                            <th scope="col">Equipamento</th>
                            <th scope="col">Grupo de Equipamentos</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>

                    <tbody class="table-success">
                        @foreach ($this->equipaments as $equipament)
                            <tr wire:key="{{ $equipament->id }}">
                                <td>{{ $equipament->Processo }}</td>
                                <td>{{ $equipament->Sistema }}</td>
                                <td>{{ $equipament->Equipamento }}</td>
                                <td>{{ $equipament['Grupo de Equipamentos'] }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <livewire:components.addable.equipamento.modal-edit
                                        wire:key="{{ $equipament->id }}" :equipamentId="$equipament->id" />

                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteEquipament" wire:key="{{ $equipament->id }}"
                                        wire:click="selectEquipament({{ $equipament->id }})">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $this->equipaments->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
                </div>
            </div>
        @else
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-0">Nenhum Equipamento registrado</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="deleteEquipament" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteEquipament" aria-hidden="true" wire:ignore.self>
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

                    @if ($equipamentSelected)
                        <p class="mb-0 fs-6">
                            Tem certeza que deseja deletar o Equipamento:
                        </p>
                        <div class="mt-3 p-3 bg-light rounded border">
                            <div class="text-center">
                                <strong>{{ $equipamentSelected->Equipamento }}</strong><br>
                                <span class="text-muted">{{ $equipamentSelected->Processo }} | </span>
                                <span class="text-muted">{{ $equipamentSelected->Sistema }} | </span>
                                <span class="text-muted">{{ $equipamentSelected['Grupo de Equipamentos'] }}</span>
                            </div>
                        </div>
                        <p class="text-danger mt-3 mb-0 fw-semibold">Esta ação não poderá ser desfeita.</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>

                    <button type="button" class="{{ $this->equipamentSelected ? '' : 'visually-hidden' }} btn btn-danger" wire:click="deleteEquipament">
                        <i class="bi bi-trash-fill me-1"></i> Deletar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
