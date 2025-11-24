<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <h1 class="fw-bold text-white">SCAP</h1>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
            aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ms-3" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active text-white" aria-current="page" href="{{ route('lobby') }}">Home</a>
                </li>

                @if (auth()->check())
                    @if (auth()->user()->NivelAcesso == 'Administrador')
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page"
                                href="{{ route('users.index') }}">Usuarios</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page"
                            href="{{ route('shift.index') }}">Turnos de Ocorrência</a>
                    </li>
                @endif
            </ul>
        </div>

        <!-- Dropdown de Usuário -->
        <div class="dropdown">

            @if (auth()->check())
                <button class="btn btn-secondary dropdown-toggle d-flex align-items-center" type="button"
                    id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>Olá, {{ auth()->user()->Nome }}</span>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                    <li>
                        <h6 class="dropdown-header">Conta - {{ auth()->user()->role['role'] }}</h6>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('users.profile') }}">Perfil</a></li>
                    <li><a class="dropdown-item" href="#">Configurações</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('login.logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i> Sair
                            </button>
                        </form>
                    </li>
                </ul>
            @else
                <a href="{{ route('login.index') }}" class="btn btn-warning btn-sm">Iniciar Sessão</a>
            @endif

        </div>

    </div>
</nav>
