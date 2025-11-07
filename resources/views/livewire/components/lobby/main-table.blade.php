<div>
    <div class="container mt-3 d-flex justify-content-between p-3 gap-3">

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Filtro</small>
                <h2 class="fs-5">Processo/Equipamento</h2>
            </div>

            <div class="">

                <div>
                    <label for="form-label">Processo</label>
                    <select wire:model.lazy="filterProcesso" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->processos as $processo)
                            <option value="{{ $processo->Processo }}">{{ $processo->Processo }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="form-label">Sistema</label>
                    <select wire:model.lazy="filterSistema" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->sistemas as $sistema)
                            <option value="{{ $sistema->Sistema }}">{{ $sistema->Sistema }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="form-label">Equipamento</label>
                    <select wire:model.lazy="filterEquipamento" class="form-select form-select-sm">
                        <option value="">Selecione...</option>
                        @foreach ($this->equipamentos as $equipamento)
                            <option value="{{ $equipamento->Equipamento }}">{{ $equipamento->Equipamento }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
        </div>

        <div class="border border-light-subtle rounded-2 w-50 p-3 shadow-lg">
            <div class="w-50">
                <small class="text-success">Filtro</small>
                <h2 class="fs-5">Periodo</h2>
            </div>

            <div class="">

                <div>
                    <label for="form-label">Inicio</label>
                    <input wire:model.live="filterDataInicio" type="datetime-local" class="form-control">
                </div>

                <div>
                    <label for="form-label">Fim</label>
                    <input wire:model.live="filterDataFim" type="datetime-local" class="form-control">
                </div>

            </div>
        </div>
    </div>

    <div class="container shadow-lg mt-4 p-3">
        <div class="d-flex justify-content-between p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Paradas
            </div>

            <div>
                <button class="btn btn-outline-warning" wire:click="refreshFilters">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
        </div>
        <table class="table text-center table-bordered table-striped table-hover caption-top">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Producao</th>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Data Inicio</th>
                    <th scope="col">Data Fim</th>
                    <th scope="col">Duracao</th>
                    <th scope="col">EqpGerador</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            <tbody class="table-info">
                @foreach ($this->paradas as $parada)
                    <tr>
                        <td>{{ $parada->Id }}</td>
                        <td>{{ $parada->Producao ? $parada->Producao : 'Sem processo aparente' }}</td>
                        <td>{{ $parada->Equipamento ? $parada->Equipamento : 'Sem equipamento' }}</td>
                        <td>{{ $parada->DataInicio ? $parada->data_inicial->format('d/m/Y H:i') : 'Sem data inicial' }}
                        </td>
                        <td>{{ $parada->DataInicio ? $parada->data_final->format('d/m/Y H:i') : 'Sem data inicial' }}
                        </td>
                        <td>{{ $parada->Duracao ? $parada->Duracao . 'min' : 'Sem duracao' }}</td>
                        <td>{{ $parada->EqpGerador ? $parada->EqpGerador : 'Sem Equipamento Gerador' }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-primary"><i class="bi bi-pen"></i></button>

                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#insertSameLine{{ $loop->index }}"><i
                                        class="bi bi-copy"></i></button>

                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteLine" wire:click="selectToDelete({{ $parada->Id }})"><i
                                        class="bi bi-x-square"></i></button>

                                <button class="btn btn-sm btn-primary">12</button>
                            </div>
                        </td>
                    </tr>

                    <div class="modal fade" id="insertSameLine{{ $loop->index }}" data-bs-backdrop="static"
                        wire:ignore.self>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Copiar Linha</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    @if (isset($messageCopyLine[$parada->Id]['message']))
                                        <div class="alert alert-{{ $messageCopyLine[$parada->Id]['severity'] }} alert-dismissible fade show"
                                            role="alert">
                                            <strong>{{ $messageCopyLine[$parada->Id]['message'] }}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif

                                    <p>Tem certeza que deseja inserir uma linha igual a linha de id:
                                        {{ $parada->Id }}</p>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Fechar</button>
                                    <button type="button" class="btn btn-primary"
                                        wire:click="insertSameLine({{ $parada->Id }})">Inserir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="modal fade" id="deleteLine" data-bs-backdrop="static" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Delear Linha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                @if (isset($messageDeleteLine['message']))
                                    <div class="alert alert-{{ $messageDeleteLine['severity'] }} alert-dismissible fade show"
                                        role="alert">
                                        <strong>
                                            @if (isset($messageDeleteLine['icon']))
                                                <i class="{{ $messageDeleteLine['icon'] }}"></i>
                                            @endif
                                            {{ $messageDeleteLine['message'] }}
                                        </strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if ($selectedToDelete)
                                    <p>Tem certeza que deseja deletar a linha de id:
                                        {{ $selectedToDelete->Id ?? null }}
                                    </p>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Fechar</button>

                                @if ($selectedToDelete)
                                    <button type="button" class="btn btn-danger"
                                        wire:click="deleteParada({{ $selectedToDelete->Id }})">Deletar</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </tbody>
        </table>
        <div>
            {{ $this->paradas->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
        </div>
    </div>
</div>
