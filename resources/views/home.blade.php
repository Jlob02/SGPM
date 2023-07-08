@extends('master')

@section('title')
Home
@endsection

@section('content')

<!--main content-->
<div class="row">
    <div class="col-1">
    </div>
    <div class="col-10 mb-4">
        <div class="row m-1 g-4">
            <div class="col-3">
                <div class="row ">
                    <form class="col-12  p-4 shadow bg-white p-1 mt-1" action="/home" method="get">
                        <h4 class="mb-2">{{__('global.filters')}}</h4>

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
                                <option value="0" selected>Família</option>
                                @isset($familias)
                                @foreach($familias as $familia)
                                <option value="{{$familia->id}}">{{$familia->familia}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>

                        <div class="btn-group  w-100">
                            <select name="subfamilia_id" class="form-select form-select-sm m-1 bg-body-secondary" aria-label="Default select example">
                                <option value="0" selected>Sub-família</option>
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
                            <button type="submit" class="btn btn-sm _nav w-50 mt-3 me-1  mb-3">{{__('global.filter')}}</button>
                            <a href="/home" class="btn btn-sm _nav w-50 mt-3 ms-1 mb-3">{{__('global.clean')}}</a>
                        </div>
                    </form>
                </div>

                <div class="row mt-2">
                    <div class="col-12 p-4 shadow  bg-white">
                        <h6 class="mb-2">{{__('global.recent-activities')}}</h6>
                        <div class="bg-body-secondary p-2" style="max-height: 150px; overflow: scroll; overflow-x: hidden;">
                            @foreach($logs as $log)
                            <p class="texto mb-0">{{$log->user->u_nome}} {{$log->acao}} {{\Carbon\Carbon::parse($log->data_hora)->diffForHumans()}}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-9">

                <div class="row bg-white shadow m-1 p-1">
                    <div class="col-8 d-flex align-items-center ">

                    </div>
                    <div class="col-4">
                        <form class="d-flex" role="search" action="/home" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="{{__('global.search')}}" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row m-1   _list ">
                    <div class="col-12 ">
                        @isset($precos)
                        @foreach($precos as $preco)
                        <a href="materia-prima/{{$preco->materiaprima->codigo->id}}" class="row d-flex align-items-center _list_item bg-white shadow mt-2 p-2 ">
                            <div class="col-9">
                                <div class="row">
                                    <div class="col-5">
                                        DESCRIÇÃO : {{$preco->materiaprima->designacao}}
                                    </div>
                                    <div class="col-4">
                                        CÓDIGO : {{$preco->materiaprima->codigo->codigo}}
                                    </div>
                                    <div class="col-3">
                                        FAMÍLIA : {{$preco->materiaprima->familia->familia}}
                                    </div>
                                    <div class="col-5">
                                        DATA : {{$preco->data_inicio}} a {{$preco->data_fim}}
                                    </div>
                                    <div class="col-4">
                                        EMPRESA : {{$preco->materiaprima->empresa->nome}}
                                    </div>
                                    <div class="col-3">
                                        PAÍS : Portugal
                                    </div>
                                    <div class="col-5">
                                        FORNECEDOR : {{$preco->fornecedor->nome}}
                                    </div>
                                    <div class="col-7">
                                        QUANTIDADE MINIMA :
                                        @if($preco->quantidade_minima==1)
                                        Camião completo
                                        @endif
                                        @if($preco->quantidade_minima==2)
                                        >= 1 Palete
                                        @endif
                                        @if($preco->quantidade_minima==3)
                                        < 1 Palete @endif @if($preco->quantidade_minima==4)
                                            Não aplicável
                                            @endif
                                    </div>
                                    <div class="col-12">
                                        OBSERVAÇÕES : {{$preco->observacao}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                PREÇO : {{$preco->preco}} EUR
                            </div>
                            @if($preco->sinal == 3)
                            <div class="col-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="red" class="bi bi-caret-up-fill" viewBox="0 0 16 16">
                                    <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z" />
                                </svg>
                            </div>
                            @else
                            <div class="col-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="green" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                </svg>
                            </div>
                            @endif
                        </a>
                        @endforeach
                        @endisset
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