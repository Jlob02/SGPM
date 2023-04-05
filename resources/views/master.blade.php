<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="css/style.css">
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <!--navbar-->
        <header class="row _navbar ">
            <div class="col-9"></div>
            <div class="col-3 text-white  p-2 d-flex justify-content-around align-items-center">
                @auth
                <span>Olá {{Auth::user()->u_nome}}</span> |
                <a href="#" class="text-white">Meu perfil</a> |
                <a href="/logout" class="text-white">Sair</a> |
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <button class="btn text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            PT
                        </button>
                        <ul class="dropdown-menu ">
                            <li><a class="dropdown-item" href="#">EN</a></li>
                            <li><a class="dropdown-item" href="#">FR</a></li>
                            <li><a class="dropdown-item" href="#">JP</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="col-1"></div>

            <div class="col-10 mt-3">
                <ul class="nav nav-tabs " >
                    <li class="nav-item  me-1 ">
                        @if (Request::path() =='home')
                        <a class="nav-link text-black active" aria-current="page" href="/home">Home</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" aria-current="page" href="/home">Home</a>
                        @endif
                    </li>
                    <li class="nav-item me-1">
                        @if (Request::path() =='materia-prima')
                        <a class="nav-link text-black active" href="/materia-prima">Matéria-prima</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/materia-prima">Matéria-prima</a>
                        @endif
                    </li>
                    @if(Auth::user()->u_tipo != 3)
                    @if(Auth::user()->u_tipo != 2)
                    <li class="nav-item me-1">
                        @if (Request::path() =='empresas' or Request::path() =='adicionar-empresa')
                        <a class="nav-link text-black active " href="/empresas">Empresas</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/empresas">Empresas</a>
                        @endif
                    </li>
                    @endif

                    <li class="nav-item me-1 ">
                        @if (Request::path() =='funcionarios' or Request::path() =='adicionar-funcionario')
                        <a class="nav-link text-black active" href="/funcionarios">Funcionários</a>
                        @else
                        <a class="nav-link text-white bg-secondary" style="--bs-bg-opacity: .7;" href="/funcionarios">Funcionários</a>
                        @endif
                    </li>
                    @endif
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