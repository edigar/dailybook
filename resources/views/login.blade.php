<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dailybook - Login</title>
    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Dailybook - Login</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('authenticate') }}">
                            @csrf

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif

                            <div class="form-group mt-2">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required autofocus>
                            </div>

                            <div class="form-group mt-4">
                                <label for="password">Senha</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group my-3">
                                Não tem login ainda?
                                <a href="{{ route('get.register') }}">Clique aqui.</a>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
