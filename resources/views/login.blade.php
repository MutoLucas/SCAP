<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - SCAP</title>
    @vite(['resources/js/app.js', 'resources/sass/app.scss'])
</head>

<body class="bg-secondary">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="card p-4" style="width: 100%; max-width: 400px;">
            <h3 class="card-title text-center fw-bold">SCAP</h3>
            <small class="mb-3 d-flex justify-content-center">Bem-Vindo ao SCAP</small>
            <form action="{{ route('login.auth') }}" method="POST">
                @csrf

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @error('errorLogin')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror

                <div class="mb-3">
                    <label for="login" class="form-label">Login</label>
                    <input type="text" class="form-control" name="login" placeholder="Digite seu login" required>
                    @error('login')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" name="senha" placeholder="Digite sua senha" required>
                    @error('senha')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary w-100">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>
