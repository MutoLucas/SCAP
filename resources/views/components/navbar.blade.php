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
                    <a class="nav-link active text-white" aria-current="page" href="#">Home</a>
                </li>
            </ul>
        </div>

        <div>
            <span class="text-white fs-3">Bem-vindo {{ auth()->user()->Nome }}</span>
        </div>
    </div>
</nav>
