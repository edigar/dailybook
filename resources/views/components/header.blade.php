<style>
    @media (min-width: 576px) {
        .custom-search {
            width: 500px; /* Largura inicial desejada */
        }
    }

    @media (max-width: 576px) {
        .custom-search {
            width: 300px; /* Largura máxima (tela inteira) quando a tela for menor que 576px */
        }
    }
</style>

<div>
    <nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
        <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary"> -->
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-main" aria-controls="navbar-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-main">
                <a class="navbar-brand" href="{{ route('home') }}">DailyBook</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('profile') }}">Meu Perfil</a>
                    </li>
                    <li class="nav-item">
                        <form class="d-flex" role="search" action="/home" method="GET">
                            <input class="form-control me-2 custom-search" type="search" placeholder="Buscar nota" aria-label="Search" id="search" name="search" required="required">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </li>
                </ul>
                <span class="navbar-text p-0"><a href="{{ route('logout') }}">Sair</a></span>
            </div>
        </div>
    </nav>
</div>
