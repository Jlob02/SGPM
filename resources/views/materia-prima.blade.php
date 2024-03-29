@extends('master')

@section('title')
Matéria-prima
@endsection

@section('content')


<!--main content-->
<div class="row mt-1">
    <div class="col-1">
    </div>
    <div class="col-10 mb-4">
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

        <div class="row">
            <div class="col-12 m-1 mt-0 ">
                <a href="/materia-prima/precos" class="btn btn-primary btn-sm _nav">{{__('global.prices')}}</a>
                <a href="/materia-prima/alertas" class="btn btn-primary btn-sm _nav">{{__('global.alerts')}}</a>
            </div>

            <div class="col-12">
                <div class="row m-1 _navbar  d-flex align-items-center bg-white shadow p-2 pt-3 pb-3">

                    <div class="col-3 d-flex gap-3 align-items-center">
                        <div class="w-100">
                        {{__('global.order-by')}}
                        </div>
                  
                        <select onchange="ordena()" id="ordena" class="form-select form-select-sm bg-body-secondary">
                            <option value="0" selected>{{__('global.select')}}</option>
                            <option value="1">Designação</option>
                            <option value="2">Codigo</option>
                        </select>
                    </div>
                  

                    <div class="col-4 d-flex gap-3 align-items-center">
                        <div class="w-100">
                        {{__('global.filter-by')}}
                        </div>

                        <select onchange="filtra_familia()" id="familia" class="form-select form-select-sm bg-body-secondary">
                            <option value="0" selected>{{__('global.family')}}</option>
                            @isset($familias)
                            @foreach($familias as $familia)
                            <option value="{{$familia->id}}">{{$familia->familia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    
                        
                        <select onchange="filtra_subfamilia()" id="subfamilia" class="form-select form-select-sm bg-body-secondary">
                            <option value="0" selected>{{__('global.sub-family')}}</option>
                            @isset($subfamilias)
                            @foreach($subfamilias as $subfamilia)
                            <option value="{{$subfamilia->id}}">{{$subfamilia->subfamilia}}</option>
                            @endforeach
                            @endisset
                        </select>
                    </div>


                    <div class="col-2 d-flex justify-content-end">
                        <a href="/materia-prima/adicionar" class="btn btn-sm _nav "><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-plus-circle me-1" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                            </svg>{{__('global.raw-material')}}</a>
                    </div>

                    <div class="col-3 ">
                        <form class="d-flex" role="search" action="/materia-prima" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="{{__('global.search')}}" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row m-1 mt-2 _list ">
                    <div class="col-12 bg-white shadow">
                        @isset($materias_primas)
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr class="text-start">
                                    <th>{{__('global.designation')}}</th>
                                    <th>{{__('global.code')}}</th>
                                    <th>{{__('global.family')}}</th>
                                    <th>{{__('global.sub-family')}}</th>
                                    <th>{{__('global.concentration')}} %</th>
                                    <th>{{__('global.active-ingredient')}}</th>
                                    <th class="text-center">{{__('global.options')}}</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($materias_primas as $materia_prima)
                                <tr>
                                    <td> <a href="/materia-prima/empresa/{{$materia_prima->id}}">{{$materia_prima->designacao}}</a></td>
                                    <td>@isset($materia_prima->codigo->codigo){{$materia_prima->codigo->codigo}} @else {{$materia_prima->codigo}}@endif </td>
                                    <td>@isset($materia_prima->familia->familia){{$materia_prima->familia->familia}} @endisset</td>
                                    <td>@isset($materia_prima->subfamilia->subfamilia){{$materia_prima->subfamilia->subfamilia}} @endisset</td>
                                    <td>{{$materia_prima->concentracao}}</td>
                                    <td>@isset($materia_prima->codigo->principio_ativo){{$materia_prima->codigo->principio_ativo}}@else {{$materia_prima->principio_ativo}}@endif</td>
                                    <td class=" d-flex justify-content-around">

                                        @if($materia_prima->empresa_id == Auth::user()->empresa_id )
                                        <button data-bs-toggle="tooltip" title="Adicionar preço" onclick='adicionar_preco("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class="border border-0 bg-transparent" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                        </button>
                                        @endif

                                        <a data-bs-toggle="tooltip" title="Comparar preços" href="materia-prima/{{$materia_prima->codigo_id}}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="black" class="bi bi-card-list" viewBox="0 0 15 15">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z" />
                                                <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8zm0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zM4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z" />
                                            </svg>
                                        </a>

                                        <form action="/materia-prima/alterar/{{$materia_prima->id}}" method="get">
                                            @csrf
                                            <button data-bs-toggle="tooltip" title="Alterar Matéria-prima" class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>

                                        <button onclick='adicionar_alerta("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' class="border border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#exampleModal1" data-bs-toggle="tooltip" title="Adicionar alerta">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z" />
                                            </svg>
                                        </button>

                                        <button onclick='dialog("{{$materia_prima->id}}","{{$materia_prima->designacao}}")' data-bs-toggle="tooltip" title="Remover" class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                        @endisset

                    </div>
                </div>
                <div class="row m-1 bg-white shadow mt-2 p-1">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

<script>
    var i = 0;

    function filtra_familia() {
        if (document.getElementById("familia").value != 0) {
            document.location.href = '/materia-prima/filtros/1/' + document.getElementById("familia").value + '';
        }
    };

    function filtra_subfamilia() {
        if (document.getElementById("subfamilia").value != 0) {
            document.location.href = '/materia-prima/filtros/2/' + document.getElementById("subfamilia").value + '';
        }
    };

    function ordena() {
        document.location.href = '/materia-prima/filtros/3/' + document.getElementById("ordena").value + '';
    };

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
 
                                <input name="inputs[0][preco]" class="form-control form-control-sm bg-body-secondary" type="text"  placeholder="Preço de Mercado" />
                                
                                <select style="max-width: 70px;" name="inputs[0][unidade]" class=" ms-1 form-select form-select-sm bg-body-secondary">
                                <option value="1" selected>Kg</option>
                                <option value="2">T</option>
                                </select>
                                
                            </div>

                           <spam> Quant. minima: </spam> 

                            <div class="d-flex justify-content-between ">
                                
                                <select name="inputs[0][quantidade_minima]" class="ms-1 form-select form-select-sm bg-body-secondary">
                                    <option selected>Selecionar</option>
                                    <option value="1">Camião completo</option>
                                    <option value="2"> >= 1 Palete</option>
                                    <option value="3"> < 1 Palete</option>
                                    <option value="4">Não aplicável</option>
                                </select>
                            </div>
                        
                           
                            Fornecedor:

                            <div class="d-flex justify-content-between">
                                
                                <select name="inputs[0][fornecedor]" class="ms-1 form-select form-select-sm bg-body-secondary">
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
                                <input name="inputs[0][data_inicio]" class="me-2 form-control form-control-sm bg-body-secondary" type="date">
                                a
                                <input name="inputs[0][data_fim]" class="form-control form-control-sm ms-2 bg-body-secondary" type="date">
                            </div>
                        </div>
                        <div class="col-12 d-flex mt-2">
                           <input type="text" name="inputs[0][observacao]" class="form-control bg-body-secondary " placeholder="Observacões" />
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
                </form>`;
    };



    function fechar() {
        document.getElementById("adicionar_preco").innerHTML = "";
    };


    function add() {
        ++i;
        document.getElementById("add").insertAdjacentHTML('beforeend', `
                    <div id="` + i + `" >
                        <div class="col-12 text-end">
                            <button type="button" class="btn-close" aria-label="Close" onclick="removerDiv(` + i + `)"></button>
                        </div>
                        <div class="col-12 d-flex justify-content-lg-between align-items-center mt-1">
                        <div class="d-flex">
                            <input name="inputs[` + i + `][preco]" class="form-control form-control-sm bg-body-secondary" type="text"  placeholder="Preço de Mercado" />
                            <select style="max-width: 70px;" name="inputs[` + i + `][unidade]" class=" ms-1 form-select form-select-sm bg-body-secondary">
                            <option value="1" selected>Kg</option>
                            <option value="2">T</option>
                            </select>
                        </div>

                            <spam> Quant. minima: </spam> 

                            <div class="d-flex justify-content-between ">
                            
                            <select name="inputs[` + i + `][quantidade_minima]" class="ms-1 form-select form-select-sm bg-body-secondary">
                                <option selected>Selecionar</option>
                                <option value="1">Camião completo</option>
                                <option value="2"> >= 1 Palete</option>
                                <option value="3"> < 1 Palete</option>
                                <option value="4">Não aplicável</option>
                            </select>
                            </div>
                            Fornecedor:

                            <div class="d-flex justify-content-between ">
                                
                                <select name="inputs[` + i + `][fornecedor]" class="ms-1 form-select form-select-sm bg-body-secondary">
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
                                <input name="inputs[` + i + `][data_inicio]" class="me-2 form-control form-control-sm bg-body-secondary" type="date">
                                a
                                <input name="inputs[` + i + `][data_fim]" class="form-control form-control-sm ms-2 bg-body-secondary" type="date">
                            </div>
                        </div>
                        <div class="col-12 d-flex mt-2">
                           <input type="text" name="inputs[` + i + `][observacao]" class="form-control bg-body-secondary " placeholder="Observacões" />
                        </div>
                    </div>
                        `);
    }

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

    function removerDiv(idDiv) {
        var div = document.getElementById(idDiv);
        if (div) {
            div.parentNode.removeChild(div);
        }
    }
</script>

@endsection