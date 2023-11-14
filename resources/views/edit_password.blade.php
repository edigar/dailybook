<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dailybook - Perfil</title>
    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
<x-header />
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1>Atualizar senha</h1>
            <form method="POST" action="{{ route('update.password') }}">
                @method('PATCH')
                @csrf

                <div class="form-group mt-2">
                    <label for="password">Senha atual</label>
                    <input type="password" id="password" name="password" class="form-control" required class="@error('password') is-invalid @enderror">
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="password">Nova senha</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required class="@error('new_password') is-invalid @enderror">
                    @error('new_password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label for="password-confirm">Confirmação de Senha</label>
                    <input type="password" id="new_password_confirmation-confirm" name="new_password_confirmation" class="form-control" required class="@error('new_password_confirmation') is-invalid @enderror">
                    @error('new_password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-lg mt-3">Salvar</button>
                <a href="{{ route('profile') }}" class="btn btn-warning btn-lg mt-3">Voltar</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
