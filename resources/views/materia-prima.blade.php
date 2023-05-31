@extends('master')

@section('title')
Matéria-prima
@endsection

@section('content')


<!--main content-->
<div class="row mt-1">
    <div class="col-1">
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-12  mt-0 text-center">
                @if($errors->any())
                <div class="alert alert-warning mb-0" role="alert">
                    {{$errors->first()}}
                </div>
                @endif
                @if (\Session::has('success'))
                <div class="alert alert-success mb-0" role="alert">
                    {{session('success')}}
                </div>
                @endif
            </div>
        </div>

        <div class="row m-1">
            <div class="col-12 bg-body-secondary">
                <span id="adicionar_preco">

                </span>

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" id="dialog">

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" id="dialog1">

            </div>
        </div>
        <div class="row m-1">
            <div class="col-12 ms-0 m-1 p-2 mt-0 bg-white shadow">
                <a href="/materia-prima/adicionar" class="btn btn-sm _nav ">Adicionar matéria-prima</a>
                <a href="/materia-prima" class="btn btn-primary btn-sm _nav">Matérias-primas</a>
                <a href="/materia-prima/precos" class="btn btn-primary btn-sm _nav">Preços</a>
                <a href="/materia-prima/precos" class="btn btn-primary btn-sm _nav">Alertas</a>
            </div>

            <div class="col-12">
                <div class="row _navbar  d-flex align-items-center bg-white shadow p-2">

                    <div class="col-2">
                        <h7 class="titulo-1">Família</h7>
                        <select class="form-select form-select-sm bg-body-secondary">
                            <option selected>Selecionar</option>
                            @isset($familias)
                            @foreach($familias as $familia)
                            <option value="{{$familia->id}}">{{$familia->familia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-2">
                        <h7 class="titulo-1">Sub Família</h7>
                        <select class="form-select form-select-sm bg-body-secondary">
                            <option selected>Selecionar</option>
                            @isset($subfamilias)
                            @foreach($subfamilias as $subfamilia)
                            <option value="{{$subfamilia->id}}">{{$subfamilia->subfamilia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-2">
                        <h7 class="titulo-1">Fornecedor</h7>
                        <select class="form-select form-select-sm bg-body-secondary">
                            <option selected>Selecionar</option>
                            @isset($fornecedores)
                            @foreach($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-5 ">
                        <h7 class="titulo-1">Data</h7>

                        <div class="d-flex">
                            <input class="form-control form-control-sm bg-body-secondary" type="date">

                            <input class="ms-1 form-control form-control-sm bg-body-secondary" type="date">
                        </div>
                    </div>
                    <div class="col-1 d-flex justify-content-bottom ">
                        <button class=" mt-4 ms-1 btn rounded-2 btn-success btn-sm" type="submit">Filtrar</button>
                    </div>

                    <div class="col-9 d-flex align-items-center">
                        Mostrar
                        <div class="me-2 ms-2">
                            <select class="form-select form-select-sm bg-body-secondary">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </div>
                        Resultados
                    </div>
                    @isset($materias_primas)
                    <div class="col-3 mt-3">
                        <form class="d-flex" role="search" action="/materia-prima" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                    @endisset

                    @isset($precos)
                    <div class="col-3 mt-3">
                        <form class="d-flex" role="search" action="/materia-prima/precos" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                    @endisset

                </div>

                <div class="row mt-2 _list ">
                    <div class="col-12 bg-white shadow">
                        @isset($materias_primas)
                        <table class="table table-striped table-sm table-hover">
                            <thead>
                                <tr class="text-start">
                                    <th>Designação</th>
                                    <th>Codigo</th>
                                    <th>Família</th>
                                    <th>SubFamília</th>
                                    <th>Concentração %</th>
                                    <th>Principio ativo</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($materias_primas as $materia_prima)
                                <tr>
                                    <td> <a href="materia-prima/{{$materia_prima->codigo->id}}">{{$materia_prima->designacao}}</a></td>
                                    <td>{{$materia_prima->codigo->codigo}}</td>
                                    <td>@isset($materia_prima->familia->familia){{$materia_prima->familia->familia}} @endisset</td>
                                    <td>@isset($materia_prima->subfamilia->subfamilia){{$materia_prima->subfamilia->subfamilia}} @endisset</td>
                                    <td>{{$materia_prima->concentracao}}</td>
                                    <td>{{$materia_prima->codigo->principio_ativo}}</td>
                                    <td class=" d-flex justify-content-around">

                                        @if($materia_prima->empresa_id == Auth::user()->empresa_id )
                                        <button onclick='adicionar_preco("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class="btn btn-sm badge  btn-success " type="button">
                                            Adicionar preço
                                        </button>
                                        @endif

                                        <button onclick='adicionar_alerta("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class="border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                                            </svg>
                                        </button>


                                        <form action="/materia-prima/alterar/{{$materia_prima->id}}" method="get">
                                            @csrf
                                            <button class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>

                                        <button onclick='dialog("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        @endisset

                        @isset($precos)
                        <table class="table table-striped table-sm table-hover">
                            <thead>
                                <tr class="text-start">
                                    <th>Materia prima</th>
                                    <th>Fornecedor</th>
                                    <th>Quant. minima</th>
                                    <th>Data de inicio</th>
                                    <th>Data de fim</th>
                                    <th>preco</th>
                                    <th>Unidade</th> 
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($precos as $preco)
                                <tr>
                                    <td>{{$preco->materiaprima->designacao}}</td>
                                    <td>{{$preco->fornecedor->nome}}</td>
                                    <td> @if($preco->quantidade_minima==1) 
                                                Camião completo
                                        @endif
                                        @if($preco->quantidade_minima==2) 
                                                >= 1 Palete
                                        @endif
                                        @if($preco->quantidade_minima==3) 
                                                < 1 Palete
                                        @endif
                                        @if($preco->quantidade_minima==4) 
                                                Não aplicável
                                        @endif</td>
                                    <td>{{$preco->data_inicio}}</td>
                                    <td>{{$preco->data_fim}}</td>
                                    <td>{{$preco->preco}} EUR</td>
                                    <td>@if($preco->unidade == 1)
                                        Kg
                                        @else
                                        T
                                        @endif
                                    </td>
                                    
                                    <td class=" d-flex justify-content-around">

                                        <form action="/materia-prima/preco/apagar/{{$preco->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                </svg></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                        </table>
                        @endisset
                    </div>
                </div>
                <div class="row bg-white shadow mt-2 p-1">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        @isset($materias_primas)
                        @if ($materias_primas->links()->paginator->hasPages())
                        <ul class="pagination mb-0">
                            {{ $materias_primas->onEachSide(3)->links() }}
                        </ul>
                        @else
                        <nav aria-label="Page navigation ">
                            <ul class="pagination mb-0 ">
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        @endif
                        @endisset

                        @isset($precos)
                        @if ($precos->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $precos->onEachSide(3)->links() }}
                        </ul>
                        @else
                        <nav aria-label="Page navigation ">
                            <ul class="pagination mb-0 p-1">
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link disabled" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        @endif
                        @endisset
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

<script>
    function adicionar_alerta(id, nome) {

        document.getElementById("dialog1").innerHTML = `
        <form action="/materia-prima/alerta/` + id + `" method="post">
            @csrf
                <div class="modal-content">
                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Criar Alerta</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5>` + nome + `</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-4 ">
                                               Preço minimo
                                            </div>
                                            <div class="col-4">
                                                <input name="preco_minimo" class="form-control form-control-sm bg-body-secondary" type="float" />
                                            </div>
                                            <div class="col-4"> </div>

                                            <div class="col-4 mt-2">
                                               Preço maximo
                                            </div>
                                            <div class="col-4 mt-2">
                                                <input name="preco_maximo" class="form-control form-control-sm bg-body-secondary" type="float" />
                                            </div>
                                            <div class="col-4"> </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Criar</button>
                    </div>
                </div>
        </form>`;
    };



    function adicionar_preco(id, designacao) {

        document.getElementById("adicionar_preco").innerHTML = `
        <form action="/materia-prima/preco/` + id + `" method="post">
                    @csrf
                    <div class="row bg-white shadow border-black p-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn-close" aria-label="Close" onclick="fechar()"></button>
                        </div>
                        <div class="col-12 mb-3">
                            Materia-prima : ` + designacao + `
                        </div>

                        <div class="col-12 d-flex justify-content-lg-between align-items-center">
                            <div class="d-flex">
 
                                <input name="preco" class="form-control form-control-sm bg-body-secondary" type="text"  placeholder="Preço de Mercado" />
                                
                                <select style="max-width: 70px;" name="unidade" class=" ms-1 form-select form-select-sm bg-body-secondary">
                                <option value="1" selected>Kg</option>
                                <option value="2">T</option>
                                </select>
                                
                            </div>

                           <spam> Quant. minima: </spam> 

                            <div class="d-flex justify-content-between ">
                                
                                <select name="quantidade_minima" class="ms-1 form-select form-select-sm bg-body-secondary">
                                    <option selected>Selecionar</option>
                                    <option value="1">Camião completo</option>
                                    <option value="2"> >= 1 Palete</option>
                                    <option value="3"> < 1 Palete</option>
                                    <option value="4">Não aplicável</option>
                                </select>
                            </div>
                        
                           
                            Fornecedor:

                            <div class="d-flex justify-content-between ">
                                
                                <select name="fornecedor" class="ms-1 form-select form-select-sm bg-body-secondary">
                                    <option selected>Selecionar</option>
                                    @isset($fornecedores)
                                    @foreach($fornecedores as $fornecedor)
                                        <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                                    @endforeach
                                    @endisset
                                </select>
                            </div>


                            Periodo:

                            <div class="d-flex align-items-center w-25">
                                <input name="data_inicio" class="me-2 form-control form-control-sm bg-body-secondary" type="date">
                                a
                                <input name="data_fim" class="form-control form-control-sm ms-2 bg-body-secondary" type="date">
                            </div>
                        </div>
                        <div class="col-12 d-flex mt-2">
                           <input type="text" name="observacao" class="form-control bg-body-secondary " placeholder="Observacões" />
                        </div>
                        <span id="add">

                        </span>     
                        <div class="col-12 mt-2 text-end">
                            <button class=" border-0" type="button" onclick="add()">
                                +
                            </button>

                            <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                        </div>
                    </div>
                </form>     
                `;
    };



    function fechar() {

        document.getElementById("adicionar_preco").innerHTML = "";

    };


    function add() {

        document.getElementById("add").innerHTML += `
        
                        <div class="col-12 d-flex justify-content-lg-between align-items-center mt-1">
                            <div class="d-flex w-25">
                                <input name="preco" class="form-control form-control-sm bg-body-secondary" type="text"  placeholder="Preço de Mercado" />

                                <select name="unidade" class="w-25 ms-3 form-select form-select-sm bg-body-secondary ">
                                <option value="1" selected>Kg</option>
                                <option value="2">T</option>
                                </select>
                            </div>
                        
                            Fornecedor:

                            <div class="d-flex justify-content-between ">
                                
                                <select name="fornecedor" class="ms-1 form-select form-select-sm bg-body-secondary">
                                    <option selected>Selecionar</option>
                                    @isset($fornecedores)
                                    @foreach($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                            @endforeach
                            @endisset
                                </select>
                            </div>

                            Periodo:

                            <div class="d-flex align-items-center w-25">
                                <input name="data_inicio" class="me-2 form-control form-control-sm bg-body-secondary" type="date">
                                a
                                <input name="data_fim" class="form-control form-control-sm ms-2 bg-body-secondary" type="date">
                            </div>
                        </div>
                        <div class="col-12 d-flex mt-2">
                           <input type="text" name="observacao" class="form-control bg-body-secondary " placeholder="Observacões" />
                        </div>`;

    };

    function dialog(id, nome) {

        document.getElementById("dialog").innerHTML = `
        <form action="/materia-prima/apagar/` + id + `" method="post">
            @csrf
             @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem a certeza que quer apagar a materia-prima ` + nome + `?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Apagar</button>
                                    </div>
                                </div>
                            </form>`;

    }
</script>

@endsection