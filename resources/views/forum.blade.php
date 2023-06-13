@extends('master')

@section('title')
Fórum
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>

    <div class="col-10">
        <div class="row m-1 gap-4">
            <div class="col-3 ">
                <div class="row bg-white shadow" style="height: 250px;">
                    <div class="col-12 p-4">
                        <h6 class="titulo-1">Categorias</h6>
                        <hr>
                        @foreach($categorias as $categoria)
                       
                        <div class="d-flex mb-0 justify-content-between">
                            <a href="/forum/topicos/{{$categoria[0]->familia->id}}" class="mb-0 mt-0">{{$categoria[0]->familia->familia}}</a>
                            <p class="me-4 mb-0 mt-0">{{$categoria->count()}}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-8 ">

                <div class="row d-flex align-items-center bg-white shadow p-2">
                    <div class="col-8">
                        <a href="/forum/novo-topico" class="btn btn-sm btn-success"> Criar novo tópico</a>
                    </div>
                    <div class="col-4">
                        <form class="d-flex" role="search" action="/forum" method="get">
                            <input name="search" class="form-control form-control-sm bg-body-secondary me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 _list">
                        <div class="row">
                            @isset($topicos)
                            @foreach($topicos as $topico)
                            <div class="col-12 bg-white mt-2 shadow p-2 ps-3 pe-3">
                                <H4 class="titulo-1">{{$topico->titulo}}</H4>
                                <p class="texto-1 ">{{$topico->descricao}}</p>
                                <div class="text-end d-flex justify-content-between">
                                    <small class="texto "> {{$topico->user->u_nome}} {{\Carbon\Carbon::parse($topico->data_hora)->diffForHumans()}} </small>
                                    <a href="forum/topico/{{$topico->id}}" class="btn texto btn-sm btn-success"> Ver mais</a>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                    </div>




                </div>



                <div class="row mt-1 ">
                    <div class="col-12 d-flex align-items-center justify-content-end bg-white shadow">
                        @isset($topicos)

                        @if ($topicos->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $topicos->onEachSide(3)->links() }}
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