<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dailybook - Home</title>
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
                    <form action="{{ route('post.note') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title" required="required" placeholder="Insira o título da sua publicação">
                        </div>
                        <div class="form-group mb-3">
                            <label for="content">Conteúdo</label>
                            <textarea class="form-control" id="content" name="content" rows="5" required="required" placeholder="Insira o conteúdo da sua publicação"></textarea>
                        </div>

                        <button class="btn btn-primary float-end" type="submit">Anotar</button>
                    </form>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="container">
        @foreach($notes as $note)
        <div class="col-xs-12 col-sm-12">
            <div class="p-3 mb-4 bg-body-tertiary rounded-4">
                <div class="container-fluid py-1">
                    <h1 class="display-6 fw-bold">{{ $note->title }}</h1>
                    <p class="col-md-12 fs-5">{{ $note->content }}</p>
                    <hr>
                    <p>{{ \Carbon\Carbon::parse($note->updated_at)->format('d/m/Y H:i:s') }}</p>
                    <div class="align-items-baseline">
                        <a href="{{ route('edit.note', $note->id) }}" class="btn btn-primary align-bottom">Editar</a>
                        <form action="{{ route('delete.note', $note->id) }}" method="POST" class="d-inline-flex">
                            @method('DEELTE')
                            @csrf
                            <input type="submit" class="btn btn-danger" value="Apagar">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</body>
</html>
