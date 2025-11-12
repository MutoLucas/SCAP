<div class="container w-75">

    <div class="container d-flex justify-content-start align-items-start p-2 gap-2">

        <div>
            <small class="fw-bold text-success">Filtros</small>
        </div>

        <div>
            <input type="text" class="form-control form-control-sm" placeholder="Login" wire:model.lazy="filterLogin">
        </div>

        <div>
            <input type="text" class="form-control form-control-sm" placeholder="Nome" wire:model.lazy="filterName">
        </div>

        <div>
            <select class="form-select form-select-sm" wire:model.lazy="filterRole">
                <option value="">Selecione...</option>
                <option value="Administrador">Administrador</option>
                <option value="Manutentor">Manutentor</option>
                <option value="Operador">Operador</option>
            </select>
        </div>

        <div>
            <button class="btn btn-sm btn-outline-warning" wire:click="resetSearch">
                <i class="bi bi-arrow-clockwise"></i>
            </button>
        </div>

    </div>

    <table class="table table-striped table-hover table-bordered">

        <thead class="text-center table-dark">
            <tr>
                <th scope="col"><i class="bi bi-person-fill"></i> Login</th>
                <th scope="col"><i class="bi bi-person-vcard-fill"></i> Nome</th>
                <th scope="col"><i class="bi bi-person-badge-fill"></i> Nivel de Acesso</th>
                <th scope="col"><i class="bi bi-info-circle-fill"></i> Ação</th>
            </tr>
        </thead>

        <tbody class="text-center table-secondary">
            @foreach ($this->logins as $login)
            <tr>
                <td class="fw-bold">{{ $login->Login }}</td>
                <td class="fw-bold">{{ $login->Nome }}</td>
                <td>
                    <span class="badge text-bg-{{ $login->role['color'] }}">
                        {{ $login->role['role'] }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-primary">
                        <i class="bi bi-info-circle"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $this->logins->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
    </div>
</div>
