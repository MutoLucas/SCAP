<div class="mb-3 p-3 border border-success rounded-3 shadow-sm bg-light">

    <div class="mb-2">
        <span class="fw-bold text-primary fs-5">
            Adicionar Componente
        </span>

        @if (isset($message['message']))
            <span class="ms-2 text-{{ $message['severity'] }} fw-semibold">
                {{ $message['message'] }}
            </span>
        @endif
    </div>

    <div class="row g-2 align-items-start">

        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Nome
                </span>
                <input type="text" class="form-control border-success" placeholder="Nome do Código" wire:model="name">
            </div>
            @error('name')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Grupo
                </span>
                <select class="form-select border-success" wire:model="group">
                    <option value="">Selecione...</option>
                    @foreach ($this->equipGroups as $equipGroup)
                        <option value="{{ $equipGroup['Grupo de Equipamentos'] }}">{{ $equipGroup['Grupo de Equipamentos'] }}</option>
                    @endforeach
                </select>
            </div>
            @error('group')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-2 d-grid">
            <button type="button" class="btn btn-success btn-sm" wire:click="storeNewComponent">
                <i class="bi bi-plus-lg"></i> Adicionar
            </button>
        </div>

    </div>

</div>
