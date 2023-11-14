<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dailybook - Cadastro</title>
    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dailybook - Cadastro de usuário</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('post.register') }}">
                            @csrf

                            <div class="form-group mt-3">
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" class="form-control" required autofocus class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required class="@error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="password">Senha</label>
                                <input type="password" id="password" name="password" class="form-control" required class="@error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mt-4">
                                <label for="password-confirm">Confirmação de Senha</label>
                                <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required class="@error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group my-3">
                                Já se cadastrou?
                                <a href="{{ route('login') }}">Acesse o login.</a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
