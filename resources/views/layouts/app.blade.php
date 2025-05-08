<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X5VVT3D5YF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-X5VVT3D5YF');
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('titulo', 'Loja de Eletrônicos')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/home') }}">
                Loja Caçador
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrar</a>
                        </li>
                    @else

                        @if(Auth::user()->is_admin)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="adminMenu" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Administração
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
                                    <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a></li>
                                    <li><a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('fotos.index') }}">Fotos de Produtos</a></li>
                                    <li><a class="dropdown-item" href="{{ route('cidades.index') }}">Cidades</a></li>
                                </ul>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="clienteMenu" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Área do Usuário
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="clienteMenu">
                                <li><a class="dropdown-item" href="{{ route('clientes.index') }}">Clientes</a></li>
                                <li><a class="dropdown-item" href="{{ route('enderecos.index') }}">Endereços</a></li>
                                <li><a class="dropdown-item" href="{{ route('vendas.index') }}">Vendas</a></li>
                                <li><a class="dropdown-item" href="{{ route('carrinho.index') }}">Carrinho</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li>
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Sair
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo -->
    <main class="flex-fill">
        <div class="container py-5">
            @yield('conteudo')
        </div>
    </main>

    <!-- Rodapé -->
    <footer class="bg-primary text-white text-center py-3 mt-auto">
        <div class="container">
            &copy; {{ date('Y') }} Loja de Eletrônicos – Caçador
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>