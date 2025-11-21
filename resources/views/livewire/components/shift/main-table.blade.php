<div class="container col-8">
    <div class="container d-flex justify-content-between gap-3">

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

        <div class="d-flex justify-content-between p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Ocorrencias de Turnos
            </div>

            <div class="d-flex justify-content-between gap-2">

                <button class="btn btn-outline-warning" wire:click="refreshFilters">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
        </div>
        @if ($this->ocorrencias)
        <table class="table text-center table-bordered table-striped table-hover caption-top">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Processo</th>
                    <th scope="col">Sistema</th>
                    <th scope="col">Equipamento</th>
                    <th scope="col">Data</th>
                    <th scope="col">Turno</th>
                    <th scope="col">Operador</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>

            <tbody class="table-info">
                @foreach ($this->ocorrencias as $ocorrencia)
                <tr wire:key="{{ $ocorrencia->Id }}">
                    <td>{{ $ocorrencia->Processo }}</td>
                    <td>{{ $ocorrencia->Sistema }}</td>
                    <td>{{ $ocorrencia->Equipamento }}</td>
                    <td>{{ $ocorrencia->data->format('d/m/Y H:i') }}</td>
                    <td>{{ $ocorrencia->Turno }}</td>
                    <td>
                        <span class="badge text-bg-primary"><i class="bi bi-person"></i>{{ $ocorrencia->Operador }}</span>
                    </td>
                    <td>
                        <livewire:components.shift.modal-edit wire:key="{{ $ocorrencia->Id }}" :key="$ocorrencia->Id" :ocorrenciaId="$ocorrencia->Id"/>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>
            {{ $this->ocorrencias->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
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
