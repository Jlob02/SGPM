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
            <div class="col-12  m-1 text-center">
                @if($errors->any())
                <div class="alert alert-warning" role="alert">
                    {{$errors->first()}}
                </div>
                @endif
                @if (\Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
                @endif
            </div>
        </div>

        <div class="row m-1 mt-0">
            <div class="col-12 bg-body-secondary">
                <span id="adicionar_preco">

                </span>

            </div>
        </div>

        <div class="row">
            <div class="col-12 m-1 mt-0">
                <a href="/materia-prima/adicionar" class="btn btn-primary btn-sm bg-info bg-gradient ">Adicionar matéria-prima</a>
                <a href="/materia-prima" class="btn btn-primary btn-sm bg-info bg-gradient">Listar matérias-primas</a>
                <a href="/materia-prima/precos" class="btn btn-primary btn-sm bg-info bg-gradient">Listar preços</a>
            </div>

            <div class="col-12">
                <div class="row _navbar text-white d-flex  align-items-center rounded-top-2 m-1 p-2">
                    <div class=" mt-2 mb-2 col-2">
                        <h6>Ordenar por</h6>
                    </div>
                    <div class=" col-2">
                        <h6>Familia</h6>
                    </div>
                    <div class=" col-2">
                        <h6>Sub Familia</h6>
                    </div>
                    <div class=" col-2">
                        <h6>Fornecedor</h6>
                    </div>
                    <div class=" col-4 d-flex ">
                        <h6>Data</h6>
                    </div>

                    <div class=" col-2">
                        <select class="form-select form-select-sm">
                            <option selected>Ordenar por</option>
                            <option value="1">20</option>
                            <option value="2">30</option>
                            <option value="3">40</option>
                        </select>
                    </div>

                    <div class="col-2 ">
                        <select class="form-select form-select-sm">
                            <option selected>Familia</option>
                            @isset($familias)
                            @foreach($familias as $familia)
                            <option value="{{$familia->id}}">{{$familia->familia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-2 ">
                        <select class="form-select form-select-sm">
                            <option selected>Sub-familia</option>
                            @isset($subfamilias)
                            @foreach($subfamilias as $subfamilia)
                            <option value="{{$subfamilia->id}}">{{$subfamilia->subfamilia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-2">
                        <select class="form-select form-select-sm">
                            <option selected>Fornecedor</option>
                            @isset($fornecedores)
                            @foreach($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>

                    <div class="col-4 d-flex">
                        <input class="form-control form-control-sm" type="date">

                        <input class="ms-1 form-control form-control-sm" type="date">

                        <button class="ms-2 btn btn-sm rounded-2 btn-success btn-sm" type="submit">Filtrar</button>
                    </div>

                    <div class="col-9 d-flex align-items-center">
                        Mostrar
                        <div class="me-2 ms-2">
                            <select class="form-select form-select-sm ">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </div>
                        Resultados
                    </div>

                    <div class="col-3 mt-3">
                        <form class="d-flex" role="search">
                            <input class="form-control form-control-sm me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn rounded-5 btn-success " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>

                </div>

                <div class="row p-1 _list">
                    <div class="col-12 ">

                        @isset($materias_primas)
                        <table class=" table-sm table table-hover">

                            <tr class="text-start">
                                <th>Designação</th>
                                <th>Codigo</th>
                                <th>Familia</th>
                                <th>SubFamilia</th>
                                <th>Concentração %</th>
                                <th>Principio ativo</th>
                                <th>Opções</th>
                            </tr>
                            <tbody class="table-group-divider">
                                @foreach($materias_primas as $materia_prima)
                                <tr>
                                    <td>{{$materia_prima->designacao}}</td>
                                    <td>{{$materia_prima->codigo}}</td>
                                    <td>{{$materia_prima->familia}}</td>
                                    <td>{{$materia_prima->subfamilia}}</td>
                                    <td>{{$materia_prima->concentracao}}</td>
                                    <td>{{$materia_prima->principio_activo}}</td>
                                    <td class=" d-flex justify-content-around">
                                        <button onclick='adicionar_preco("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class="badge rounded-pill text-bg-success " type="button">
                                            Adicionar preço
                                        </button>

                                        <form action="/materia-prima/alterar/{{$materia_prima->id}}" method="get">
                                            @csrf
                                            <button class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>

                                        <form action="/materia-prima/apagar/{{$materia_prima->id}}" method="post">
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

                        @isset($precos)
                        <table class=" table-sm table table-hover">

                            <tr class="text-start">
                                <th>Materia prima</th>
                                <th>Fornecedor</th>
                                <th>preco</th>
                                <th>Unidade</th>
                                <th>Data de inicio</th>
                                <th>Data de fim</th>
                                <th>Opções</th>
                            </tr>
                            <tbody class="table-group-divider">
                                @foreach($precos as $preco)
                                <tr>
                                    <td>{{$preco->materia_prima_id}}</td>
                                    <td>{{$preco->fornecedor_id}}</td>
                                    <td>{{$preco->preco}}</td>
                                    <td>@if($preco->unidade == 1)
                                        Kg
                                        @else
                                        T
                                        @endif
                                    </td>
                                    <td>{{$preco->data_inicio}}</td>
                                    <td>{{$preco->data_fim}}</td>
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
                <div class="row _navbar rounded-bottom-2 m-1 ">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        @isset($materias_primas)
                        @if ($materias_primas->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $materias_primas->onEachSide(3)->links() }}
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
    function adicionar_preco(id, designacao) {

        document.getElementById("adicionar_preco").innerHTML = `
        <form action="/materia-prima/preco/` + id + `" method="post">
                    @csrf
                    <div class="row border-1 border-black p-2">
                        <div class="col-12 text-end">
                            <button type="button" class="btn-close" aria-label="Close" onclick="fechar()"></button>
                        </div>
                        <div class="col-12  ">
                            Materia-prima : ` + designacao + `
                        </div>

                        <div class="col-12 d-flex justify-content-lg-between align-items-center">
                            Preço de mercado:
                            <div class="d-flex w-25">
 
                                <input name="preco" class="form-control form-control-sm" type="text" />

                                <select name="unidade" class="w-25 ms-3 form-select form-select-sm ">
                                <option value="1" selected>Kg</option>
                                <option value="2">T</option>
                                </select>
                            </div>
                        
                            Fornecedor:

                            <div class="d-flex justify-content-between ">
                                
                                <select name="fornecedor" class="ms-1 form-select form-select-sm ">
                                    <option valuse="1" selected>Fornecedor</option>
                                    @isset($fornecedores)
                                    @foreach($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                            @endforeach
                            @endisset
                                </select>
                            </div>

                            Periodo:

                            <div class="d-flex align-items-center w-25">
                                <input name="data_inicio" class="me-2 form-control form-control-sm" type="date">
                                a
                                <input name="data_fim" class="form-control form-control-sm ms-2" type="date">
                            </div>
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
        
                        <div class="col-12 d-flex justify-content-lg-between align-items-center">
                            Preço de mercado:
                            <div class="d-flex w-25">
 
                                <input name="preco" class="form-control form-control-sm" type="text" />

                                <select name="unidade" class="w-25 ms-3 form-select form-select-sm ">
                                <option value="1" selected>Kg</option>
                                <option value="2">T</option>
                                </select>
                            </div>
                        
                            Fornecedor:

                            <div class="d-flex justify-content-between ">
                                
                                <select name="fornecedor" class="ms-1 form-select form-select-sm ">
                                    <option value="1" selected>Fornecedor</option>
                                    @isset($fornecedores)
                                    @foreach($fornecedores as $fornecedor)
                            <option value="{{$fornecedor->id}}">{{$fornecedor->nome}}</option>
                            @endforeach
                            @endisset
                                </select>
                            </div>

                            Periodo:

                            <div class="d-flex align-items-center w-25">
                                <input name="data_inicio" class="me-2 form-control form-control-sm" type="date">
                                a
                                <input name="data_fim" class="form-control form-control-sm ms-2" type="date">
                            </div>
                        </div>`;

    };
</script>

@endsection