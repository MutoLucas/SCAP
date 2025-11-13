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
                    @if(in_array($login->NivelAcesso,['Administrador','Operador','Manutentor']))
                    <button type="button" class="btn btn-sm btn-primary" wire:click="setUserToEdit('{{ $login->Login }}')" data-bs-toggle="modal" data-bs-target="#editUser">
                        <i class="bi bi-info-circle"></i>
                    </button>
                    @else

                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $this->logins->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
    </div>

    <div id="editUser" class="modal fade" tabindex="-1" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario: {{ $userToEdit->Nome ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    @if(isset($messageModalEdit['message']))
                    <div class="alert {{ $messageModalEdit['severity'] }} alert-dismissible fade show" role="alert">
                        <strong><i class="{{ $messageModalEdit['icon'] }}"></i></strong> {{ $messageModalEdit['message'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Nivel de Acesso</label>
                        <select class="form-select form-select-sm" wire:model="editRole">
                            <option value="">Selecione...</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Manutentor">Manutentor</option>
                            <option value="Operador">Operador</option>
                        </select>
                        @error('editRole')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-warning" wire:click="resetPassword">Resetar Senha</button>
                    <button type="button" class="btn btn-primary" wire:click="updateRole">Alterar Nivel de Acesso</button>
                </div>
            </div>
        </div>
    </div>
</div>
