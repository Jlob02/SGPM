@extends('master')

@section('title')
Home
@endsection

@section('content')

<!--main content-->
<div class="row">
    <div class="col-1">
    </div>
    <div class="col-10">
        <div class="row m-1 g-4">
            <div class="col-3">
                <div class="row ">
                    <form class="col-12  p-4 shadow bg-white p-1 mt-1" action="/home" method="get">
                        <h4 class="mb-2">Filtros</h4>

                        <div class="btn-group mt-2 w-100">
                            <select name="empresa_id" class="form-select form-select-sm m-1 bg-body-secondary" aria-label="Default select example">
                                <option value="0" selected>Empresa</option>
                                @isset($empresas)
                                @foreach($empresas as $empresa)
                                <option value="{{$empresa->id}}">{{$empresa->nome}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="btn-group  w-100">
                            <select name="familia_id" class="form-select form-select-sm m-1 bg-body-secondary" aria-label="Default select example">
                                <option value="0" selected>Familia</option>
                                @isset($familias)
                                @foreach($familias as $familia)
                                <option value="{{$familia->id}}">{{$familia->familia}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="btn-group  w-100">
                            <select name="subfamilia_id" class="form-select form-select-sm m-1 bg-body-secondary" aria-label="Default select example">
                                <option value="0" selected>Sub-familia</option>
                                @isset($subfamilias)
                                @foreach($subfamilias as $subfamilia)
                                <option value="{{$subfamilia->id}}">{{$subfamilia->subfamilia}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="btn-group  w-100">
                            <input name="data1" class="form-control form-control-sm m-1 bg-body-secondary" type="date" placeholder="Default input">
                        </div>

                        <div class="btn-group  w-100">
                            <input name="data2" class="form-control form-control-sm m-1 bg-body-secondary" type="date" placeholder="Default input">
                        </div>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-sm _nav w-50 mt-3 me-1  mb-3">Filtrar</button>
                            <a href="/home" class="btn btn-sm _nav w-50 mt-3 ms-1 mb-3">Limpar</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-9">

                <div class="row bg-white shadow m-1 p-1">
                    <div class="col-9 d-flex align-items-center ">
                        Mostrar
                        <div class="me-2 ms-2">
                            <select class="form-select form-select-sm bg-body-secondary ">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </div>

                        Resultados
                    </div>
                    <div class="col-3">
                        <form class="d-flex" role="search" action="/home" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row m-1  _list">
                    <div class="col-12 ">
                        @isset($precos)
                        @foreach($precos as $preco)
                        <a href="materia-prima/{{$preco->materiaprima->codigo}}" class="row d-flex align-items-center _list_item bg-white shadow mt-2 p-2 ">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-3">
                                        DESCRIÇÃO : {{$preco->materiaprima->designacao}}
                                    </div>
                                    <div class="col-3">
                                        CÓDIGO : {{$preco->materiaprima->codigo}}
                                    </div>
                                    <div class="col-3">
                                        FAMILIA : {{$preco->materiaprima->familia->familia}}
                                    </div>
                                    <div class="col-3">

                                    </div>
                                    <div class="col-3">
                                        DATA : {{$preco->data_inicio}} a {{$preco->data_fim}}
                                    </div>
                                    <div class="col-3">
                                        EMPRESA : {{$preco->materiaprima->empresa->nome}}
                                    </div>
                                    <div class="col-3">
                                        PAIS : Portugal
                                    </div>
                                    <div class="col-3">
                                        PREÇO : {{$preco->preco}}
                                    </div>
                                    <div class="col-12">
                                        FORNECEDOR : {{$preco->fornecedor->nome}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z" />
                                </svg>
                            </div>
                        </a>
                        @endforeach
                        @endisset
                        <a href="#" class="row d-flex align-items-center _list_item bg-white shadow mt-2 p-2">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-3">
                                        DESCRIÇÃO : DINPAC 84
                                    </div>
                                    <div class="col-3">
                                        CÓDIGO: M33 5742
                                    </div>
                                    <div class="col-3">
                                        FAMILIA :
                                    </div>
                                    <div class="col-3">
                                        PREÇO : 0.0229
                                    </div>
                                    <div class="col-3">
                                        DATA: 1/04/2023
                                    </div>
                                    <div class="col-3">
                                        EMPRESA: DIN
                                    </div>
                                    <div class="col-3">
                                        PAIS : Portugal
                                    </div>
                                    <div class="col-3">
                                        LOCALIDADE : Coimbra
                                    </div>
                                    <div class="col-12">
                                        FORNECEDOR : AGRUPACION FAB. ACEITES MARINOS SA
                                    </div>
                                </div>
                            </div>
                            <div class="col-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="green" class="bi bi-triangle-fill down_triangle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row m-1 ">
                    <div class="col-12 d-flex align-items-center justify-content-end bg-white shadow">
                        @isset($precos)
                        @if ($precos->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $precos->onEachSide(3)->links() }}
                        </ul>
                        @else
                        <nav aria-label="Page navigation ">
                            <ul class="pagination mb-0 p-1">
                                <li class="page-item">
                                    <a class="page-link disabled " href="#" aria-label="Previous">
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

@endsection