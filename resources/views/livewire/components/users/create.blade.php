<div class="container w-25">

    <form class="container" wire:submit="storeLogin">
        <div class="d-flex justify-content-center border border-secondary bg bg-info-subtle p-3 rounded-top">
            <h3 class="fw-bold fs-4">Formulário de Criação</h3>
        </div>

        <div class="border-start border-end border-bottom border-secondary p-2">

            @if(isset($message['message']))
            <div class="alert {{ $message['severity'] }} alert-dismissible fade show" role="alert">
                <strong><i class="{{ $message['icon'] }}"></i></strong> {{ $message['message'] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control form-control-sm" placeholder="ex: Lucas Gabriel" wire:model="name">
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Login</label>
                <input type="text" class="form-control form-control-sm" placeholder="ex: Lucas" wire:model="login">
                @error('login')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nivel de Acesso</label>
                <select class="form-select form-select-sm" wire:model="role">
                    <option value="">Selecione...</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Manutentor">Manutentor</option>
                    <option value="Operador">Operador</option>
                </select>
                @error('role')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button class="btn btn-success w-100" type="submit">
                Cadastrar
                <span class="block spinner-border spinner-border-sm" wire:loading></span>
            </button>
        </div>
    </form>

</div>
