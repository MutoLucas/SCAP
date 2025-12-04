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

                    <button type="button" class="btn btn-sm btn-outline-danger" wire:click="selectUser('{{ $login->Login }}')" data-bs-toggle="modal" data-bs-target="#deleteUser">
                        <i class="bi bi-x-circle"></i>
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

    <div class="modal fade" id="deleteUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="deleteFalCod" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Confirmar Exclusão
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body">

                    @if (isset($messageDelete['message']))
                        <div class="alert alert-{{ $messageDelete['severity'] }} alert-dismissible fade show"
                            role="alert">
                            <strong>
                                @if (isset($messageDelete['icon']))
                                    <i class="{{ $messageDelete['icon'] }}"></i>
                                @endif
                                {{ $messageDelete['message'] }}
                            </strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($userSelected)
                        <p class="mb-0 fs-6">
                            Tem certeza que deseja deletar o Usuário:
                        </p>
                        <div class="mt-3 p-3 bg-light rounded border">
                            <div class="text-center">
                                <strong>{{ $userSelected->Nome }}</strong><br>
                                <span class="text-muted">{{ $userSelected->Login }}</span>
                            </div>
                        </div>
                        <p class="text-danger mt-3 mb-0 fw-semibold">Esta ação não poderá ser desfeita.</p>
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg me-1"></i> Cancelar
                    </button>

                    <button type="button" class="{{ $userSelected ? '' : 'visually-hidden' }} btn btn-danger" wire:click="deleteUser">
                        <i class="bi bi-trash-fill me-1"></i> Deletar
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
