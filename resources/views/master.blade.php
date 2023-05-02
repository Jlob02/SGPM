<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container-fluid">
        <!--navbar-->
        <header class="row _navbar ">
            <div class="col-12 text-white  p-2 d-flex justify-content-end align-items-center">
                @auth
                <span class="ms-1 me-2"> {{Auth::user()->u_nome}}</span> |
                <a href="/perfil" class="text-white d-flex align-items-center ms-2 me-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="me-2 bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg> Meu Perfil</a> |
                <a href="/logout" class="text-white d-flex align-items-center ms-2 me-2"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class=" me-2 bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                    </svg> Sair</a> |
                <ul class="navbar-nav me-2 ">
                    <li class="nav-item dropdown">
                        <a class="btn btn-sm text-white dropdown-toggle " data-bs-toggle="dropdown" aria-expanded="false">
                            PT
                        </a>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="#">EN</a></li>
                            <li><a class="dropdown-item" href="#">FR</a></li>
                            <li><a class="dropdown-item" href="#">JP</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-1"></div>

            <div class="col-md-10 mt-3">
                <ul class="nav nav-tabs ">
                    <li class="nav-item  me-1 ">
                        @if (Request::segment(1) =='home')
                        <a class="nav-link bg-light text-black" aria-current="page" href="/home">Home</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" aria-current="page" href="/home">Home</a>
                        @endif
                    </li>
                    <li class="nav-item me-1">
                        @if (Request::segment(1) =='materia-prima')
                        <a class="nav-link text-black bg-light" href="/materia-prima">Matéria-prima</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/materia-prima">Matéria-prima</a>
                        @endif
                    </li>
                    @if(Auth::user()->u_tipo != 3)
                    @if(Auth::user()->u_tipo != 2)
                    <li class="nav-item me-1">
                        @if (Request::segment(1) =='empresas')
                        <a class="nav-link text-black bg-light" href="/empresas">Empresas</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/empresas">Empresas</a>
                        @endif
                    </li>
                    @endif

                    <li class="nav-item me-1 ">
                        @if (Request::segment(1) =='funcionarios')
                        <a class="nav-link text-black bg-light" href="/funcionarios">Funcionários</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/funcionarios">Funcionários</a>
                        @endif
                    </li>
                    @endif
                    <li class="nav-item me-1 ">
                        @if (Request::segment(1) =='fornecedores' )
                        <a class="nav-link text-black bg-light" href="/fornecedores">Fornecedores</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/fornecedores">Fornecedores</a>
                        @endif
                    </li>
                    <li class="nav-item me-1 ">
                        @if (Request::segment(1) =='forum' )
                        <a class="nav-link text-black bg-light" href="/forum">Fórum</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/forum">Fórum</a>
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-1">

            </div>
            @endauth
        </header>
      
        <main>
            @yield('content')
        </main>



    </div>

    <!--bootstrap javascript-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.min.js" integrity="sha384-heAjqF+bCxXpCWLa6Zhcp4fu20XoNIA98ecBC1YkdXhszjoejr5y9Q77hIrv8R9i" crossorigin="anonymous"></script>
</body>

</html>