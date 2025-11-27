<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        <div class="d-flex justify-content-between p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Códigos das Falhas
            </div>

            <div class="d-flex justify-content-between gap-2">

                <select class="form-select form-select-sm" wire:model.lazy="filterGroup">
                    <option value="">Grupo...</option>
                    @foreach ($this->groups as $group)
                    <option value="{{ $group['Grupo de Código'] }}">{{ $group['Grupo de Código'] }}</option>
                    @endforeach
                </select>

                <input type="text" class="form-control form-control-sm" placeholder="Código das Falhas" wire:model.lazy="filterName">

                <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
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
                        <tr wire:key="{{ $fal->Id }}">
                            <td>{{ $fal['Grupo de Código'] }}</td>
                            <td>{{ $fal['Código das Falhas'] }}</td>
                            <td>
                                <button class="btn btn-outline-primary">
                                    <i class="bi bi-info-circle"></i>
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
</div>
