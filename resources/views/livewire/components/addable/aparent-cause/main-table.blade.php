<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        {{-- <livewire:components.addable.equipamento.form-create /> --}}

        <div class="d-flex justify-content-between align-items-end p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Equipamentos
            </div>

            <div class="">

                <div class="d-flex justify-content-between gap-1">

                    <select class="form-select form-select-sm" wire:model.lazy="filterFalCod">
                        <option value="">Codigo Falha...</option>
                        @foreach ($this->falCods as $falCod)
                            <option value="{{ $falCod['Código das Falhas'] }}">{{ $falCod['Código das Falhas'] }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Causa Aparente..." wire:model.lazy="filterName">

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
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-info-circle"></i>
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
</div>
