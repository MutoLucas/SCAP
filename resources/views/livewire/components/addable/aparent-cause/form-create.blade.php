<div class="mb-3 p-3 border border-success rounded-3 shadow-sm bg-light">

    <div class="mb-2">
        <span class="fw-bold text-primary fs-5">
            Adicionar Causa Aparente
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
                <input type="text" class="form-control border-success" placeholder="Nome da Causa" wire:model="name">
            </div>
            @error('name')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-5">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-success text-white fw-bold">
                    Falha
                </span>
                <select class="form-select border-success" wire:model="falCod">
                    <option value="">Codigo Falha</option>
                    @foreach ($this->falCods as $falCod)
                    <option value="{{ $falCod['Código das Falhas'] }}">{{ $falCod['Código das Falhas'] }}</option>
                    @endforeach
                </select>
            </div>
            @error('falCod')
                <small class="text-danger fw-bold">{{ $message }}</small>
            @enderror
        </div>

        <div class="col-md-2 d-grid">
            <button type="button" class="btn btn-success btn-sm" wire:click="storeNewAparentCause">
                <i class="bi bi-plus-lg"></i> Adicionar
            </button>
        </div>

    </div>

</div>
