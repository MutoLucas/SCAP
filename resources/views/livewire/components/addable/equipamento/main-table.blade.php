<div class="container">

    <div class="container shadow-lg mt-4 p-3">

        {{-- <livewire:components.addable.falCod.form-create /> --}}

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
                        <option value="{{ $key['Grupo de Equipamentos'] }}">{{ $key['Grupo de Equipamentos'] }}</option>
                        @endforeach
                    </select>

                    <input type="text" class="form-control form-control-sm" placeholder="Equipamento..." wire:model.lazy="name">

                    <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                        <i class="bi bi-arrow-clockwise"></i>
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
</div>
