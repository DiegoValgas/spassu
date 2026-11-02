<nav class="navbar navbar-expand-lg bg-white border-bottom">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ in_route('#books') }}" href="{{ route('books.index') }}">Livros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_route('#authors') }}" href="{{ route('authors.index') }}">Autores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_route('#subjects') }}" href="{{ route('subjects.index') }}">Assuntos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ in_route('report') }}" href="{{ route('report') }}" target="_blank">Relatório</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
