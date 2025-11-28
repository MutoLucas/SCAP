<div class="mb-3 p-3 border border-success rounded-3 shadow-sm bg-light">

    <div class="mb-2">
        <span class="fw-bold text-primary fs-5">
            Adicionar Equipamento
        </span>

        @if (isset($message['message']))
            <span class="ms-2 text-{{ $message['severity'] }} fw-semibold">
                {{ $message['message'] }}
            </span>
        @endif
    </div>

    <div class="row g-2 align-items-start justify-content-end">

        <div class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Nome
                </span>
                <input type="text" class="form-control border-success" placeholder="Nome do Equipamento"
                    wire:model="name">
            </div>
            @error('name')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Processo
                </span>
                <select class="form-select border-success" wire:model.lazy="processo">
                    <option value="">Processo...</option>
                    @foreach ($this->processos as $key)
                        <option value="{{ $key->Processo }}">{{ $key->Processo }}</option>
                    @endforeach
                </select>
            </div>
            @error('processo')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Sistema
                </span>
                <select class="form-select border-success" wire:model="sistema">
                    @if ($this->sistemas)
                        <option value="">Sistema...</option>
                        @foreach ($this->sistemas as $key)
                            <option value="{{ $key->Sistema }}">{{ $key->Sistema }}</option>
                        @endforeach
                    @else
                        <option value="">Selecione um Processo</option>
                    @endif
                </select>
            </div>
            @error('sistema')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-3">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Grupo
                </span>
                <select class="form-select border-success" wire:model="group">
                    <option value="">Grupo Equipamento...</option>
                    @foreach ($this->groupEquips as $key)
                        <option value="{{ $key['Grupo de Equipamentos'] }}">{{ $key['Grupo de Equipamentos'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            @error('group')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-2 d-grid">
            <button type="button" class="btn btn-success btn-sm" wire:click="storeNewEquipament">
                <i class="bi bi-plus-lg"></i> Adicionar
            </button>
        </div>

    </div>

</div>
