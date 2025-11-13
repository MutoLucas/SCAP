<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">Editar Perfil</h3>
                    <p class="text-muted small">Altere seu nome, login e senha. Sua função (<em>Nivel de Acesso</em>) apenas pode ser visualizado.</p>


                    @if(isset($message['message']))
                    <div class="alert {{ $message['severity'] }} alert-dismissible fade show" role="alert">
                        <strong><i class="{{ $message['icon'] }}"></i></strong> {{ $message['message'] }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form wire:submit="update">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control form-control-sm" wire:model="nome">
                            @error('nome')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" class="form-control" wire:model="login">
                            @error('login')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipo de Login</label>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-primary">{{ $this->user->role['role'] }}</span>
                                <small class="text-muted">Nivel de Acesso</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control form-control-sm" wire:model="password">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="senha_confirmation" class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control form-control-sm" wire:model="checkPassword">
                            @error('checkPassword')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center align-items-center gap-3">

                            <a href="{{ route('lobby') }}" class="btn btn-outline-dark w-50"><i class="bi bi-house"></i> Home</a>
                            <button type="submit" class="btn btn-primary w-50">
                                <i class="bi bi-save"></i> Salvar
                                <span class="block spinner-border spinner-border-sm" wire:loading></span>
                            </button>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
