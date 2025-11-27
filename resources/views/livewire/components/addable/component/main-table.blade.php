<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        {{-- <livewire:components.addable.falCod.form-create /> --}}

        <div class="d-flex justify-content-between align-items-end p-2 text-success">
            <div>
                <i class="bi bi-clock"></i> Tabela de Componentes
            </div>

            <div class="">

                <div class="d-flex justify-content-between gap-1">

                    <select class="form-select form-select-sm" wire:model.lazy="filterGroup">
                        <option value="">Grupo Equipamento...</option>
                        @foreach ($this->equipGroups as $equipGroup)
                        <option value="{{ $equipGroup['Grupo de Equipamentos'] }}">{{ $equipGroup['Grupo de Equipamentos'] }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Componente" wire:model.lazy="filterName">

                    <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                </div>
            </div>
        </div>

        @if ($this->components)
            <div class="table-responsive">
                <table class="table text-center table-bordered table-striped table-hover caption-top">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Grupo de Equipamento</th>
                            <th scope="col">Componente</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>

                    <tbody class="table-success">
                        @foreach ($this->components as $component)
                            <tr wire:key="{{ $component->Id }}">
                                <td>{{ $component['Grupo de Equipamentos'] }}</td>
                                <td>{{ $component['Componente'] }}</td>
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
                    {{ $this->components->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
                </div>
            </div>
        @else
            <div class="container py-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title mb-0">Nenhum Componente registrado</h3>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
