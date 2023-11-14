<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dailybook - Editar nota</title>
    <!-- Bootstrap via CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<body>
    <x-header />
    <div class="container">
        <div class="row mt-4 mb-5 justify-content-center">
            <div class="col-xs-10 col-sm-10">
                <h3>Nova Nota</h3>
                <fieldset>
                    <form action="{{ route('update.note', $note->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required="required" placeholder="Insira o título da sua publicação" value="{{ $note->title }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="content">Conteúdo</label>
                            <textarea class="form-control" id="content" name="content" rows="10" required="required" placeholder="Insira o conteúdo da sua publicação">{{ $note->content }}</textarea>
                        </div>

                        <button class="btn btn-primary float-end ms-2" type="submit">Salvar</button>
                        <a href="{{ route('home') }}" class="btn btn-warning float-end">Voltar</a>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
</body>
</html>
