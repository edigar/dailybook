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
                <h1>Meus dados</h1>
                <form method="POST" action="{{ route('update.user') }}">
                    @method('PATCH')
                    @csrf

                    <div class="form-group mt-4">
                        <label for="name">Nome</label>
                        <input type="text" id="name" name="name" class="form-control" required autofocus class="@error('name') is-invalid @enderror" value="{{ $user->name }}">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-4 mb-5">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required class="@error('email') is-invalid @enderror" value="{{ $user->email }}">
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group mt-2">
                        <label for="password">Confirme a senha (Se quiser alterar a senha, <a href="{{ route('edit.password') }}">clique aqui</a>.)</label>
                        <input type="password" id="password" name="password" class="form-control" required class="@error('password') is-invalid @enderror">
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg mt-3">Salvar</button>
                    <a href="{{ route('home') }}" class="btn btn-warning btn-lg mt-3">Voltar</a>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col d-flex justify-content-center">
                <form action="{{ route('delete.user') }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-lg">Apagar conta</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
