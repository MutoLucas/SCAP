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
                    <select wire:model.lazy="filterProcesso" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->processos as $processo)
                        <option value="{{ $processo->Processo }}">{{ $processo->Processo }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="form-label">Sistema</label>
                    <select wire:model.lazy="filterSistema" class="form-select form-select-sm border-primary">
                        <option value="">Selecione...</option>
                        @foreach ($this->sistemas as $sistema)
                        <option value="{{ $sistema->Sistema }}">{{ $sistema->Sistema }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="form-label">Equipamento</label>
                    <select wire:model.lazy="filterEquipamento" class="form-select form-select-sm border-primary">
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
                    <input wire:model.live="filterDataInicio" type="datetime-local" class="form-control border-primary">
                </div>

                <div>
                    <label for="form-label">Fim</label>
                    <input wire:model.live="filterDataFim" type="datetime-local" class="form-control border-primary">
                </div>

            </div>
        </div>
    </div>

    <div class="container shadow-lg mt-4 p-3">

        @if (isset($messageExecel['message']))
        <div class="alert alert-{{ $messageExecel['severity'] }} alert-dismissible fade show" role="alert">
            <strong>
                @if (isset($messageExecel['icon']))
                <i class="{{ $messageExecel['icon'] }}"></i>
                @endif
                {{ $messageExecel['message'] }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('successDivideLine'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <i class="bi bi-check-circle"></i>
                {{ Session('successDivideLine') }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('successCreateLine'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <i class="bi bi-check-circle"></i>
                {{ Session('successCreateLine') }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('successEditLine'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>
                <i class="bi bi-check-circle"></i>
                {{ Session('successEditLine') }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (Session::has('errorEditLine'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>
                <i class="bi bi-check-circle"></i>
                {{ Session('errorEditLine') }}
            </strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="d-flex justify-content-between p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Paradas
            </div>

            <div class="d-flex justify-content-between gap-2">
                <div class="input-group">
                    <input wire:model.lazy="filterId" type="text" class="form-control form-control-sm" placeholder="Ex: 2142578 (Id)">
                </div>

                <button class="btn btn-outline-warning" wire:click="refreshFilters">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>

                <button class="btn btn-outline-success" wire:click="exportToExcel">
                    <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                </button>
            </div>
        </div>
        @if ($this->paradas)
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
                    <td>{{ $parada->DataFim ? $parada->data_final->format('d/m/Y H:i') : 'Sem data inicial' }}
                    </td>
                    <td>{{ $parada->Duracao ? $parada->Duracao . 'min' : 'Não Fechada' }}</td>
                    <td>{{ $parada->EqpGerador ? $parada->EqpGerador : 'Sem Equipamento Gerador' }}</td>
                    <td>
                        @if (auth()->check())
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-primary" wire:click="editLine({{ $parada->Id }})"><i class="bi bi-pen"></i></button>

                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#insertSameLine{{ $loop->index }}"><i class="bi bi-copy"></i></button>

                            @if(auth()->user()->NivelAcesso == 'Administrador')
                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteLine" wire:click="selectToDelete({{ $parada->Id }})"><i class="bi bi-x-square"></i></button>
                            @endif

                            <button class="btn btn-sm btn-success" wire:click="selectToDivide({{ $parada->Id }})" data-bs-toggle="modal" data-bs-target="#divideLine">
                                <i class="bi bi-hr"></i>
                            </button>
                        </div>
                        @else
                        <div class="d-flex justify-content-center gap-2">
                            <button class="btn btn-sm btn-success" wire:click="editLine({{ $parada->Id }})"><i class="bi bi-eye"></i></button>
                        </div>
                        @endif
                    </td>
                </tr>

                <div class="modal fade" id="insertSameLine{{ $loop->index }}" data-bs-backdrop="static" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Copiar Linha</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                @if (isset($messageCopyLine[$parada->Id]['message']))
                                <div class="alert alert-{{ $messageCopyLine[$parada->Id]['severity'] }} alert-dismissible fade show" role="alert">
                                    <strong>{{ $messageCopyLine[$parada->Id]['message'] }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                <p>Tem certeza que deseja inserir uma linha igual a linha de id:
                                    {{ $parada->Id }}</p>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" class="btn btn-primary" wire:click="insertSameLine({{ $parada->Id }})">Inserir</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="divideLine" data-bs-backdrop="static" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Dividir Linha: {{ $selectedToDivide->Id ?? '' }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                @if (isset($messageDivideLine[$parada->Id]['message']))
                                <div class="alert alert-{{ $messageDivideLine[$parada->Id]['severity'] }} alert-dismissible fade show" role="alert">
                                    <strong>
                                        @if (isset($messageDivideLine[$parada->Id]['icon']))
                                        <i class="{{ $messageDivideLine[$parada->Id]['icon'] }}"></i>
                                        @endif
                                        {{ $messageDivideLine[$parada->Id]['message'] }}
                                    </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if (Session::has('successDivideLine'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>
                                        <i class="bi bi-check-circle"></i>
                                        {{ Session('successDivideLine') }}
                                    </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif

                                @if ($selectedToDivide)

                                <div class="w-full mb-3">
                                    <label class="form-label">Data Inicio</label>
                                    <input type="datetime-local" value="{{ \Carbon\Carbon::parse($selectedToDivide->DataInicio)->format('Y-m-d\TH:i') }}" class="form-control" disabled>
                                </div>

                                <div class="w-full mb-3">
                                    <label class="form-label">Data Fim</label>
                                    <input type="datetime-local" value="{{ \Carbon\Carbon::parse($selectedToDivide->DataFim)->format('Y-m-d\TH:i') }}" class="form-control" disabled>
                                </div>

                                <div class="w-full mb-3">
                                    <label class="form-label">Data Inicio/Fim Nova</label>
                                    <input type="datetime-local" class="form-control" wire:model="newDateInicioFim">
                                    @error('newDateInicioFim')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                                <button class="btn btn-success" type="button" wire:click="divideLine({{ $parada->Id }})"><i class="bi bi-hr"></i> Dividir</button>
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
                                <div class="alert alert-{{ $messageDeleteLine['severity'] }} alert-dismissible fade show" role="alert">
                                    <strong>
                                        @if (isset($messageDeleteLine['icon']))
                                        <i class="{{ $messageDeleteLine['icon'] }}"></i>
                                        @endif
                                        {{ $messageDeleteLine['message'] }}
                                    </strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                @endif
                                @if ($selectedToDelete)
                                <p>Tem certeza que deseja deletar a linha de id:
                                    {{ $selectedToDelete->Id ?? null }}
                                </p>
                                @endif
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>

                                @if ($selectedToDelete)
                                <button type="button" class="btn btn-danger" wire:click="deleteParada({{ $selectedToDelete->Id }})">Deletar</button>
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
        @else
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h3 class="card-title mb-0">Favor, Selecionar um período</h3>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
