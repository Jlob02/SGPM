@extends('master')

@section('title')
Fórum
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>

    <div class="col-10">
        <div class="row m-1 gap-3">
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

                <div class="row d-flex align-items-center bg-white shadow p-1">
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
                    <div class="col-12 _list1">

                        <div class="row">
                            <div class="col-12 bg-white shadow mt-2 p-3">
                                <H5 class="titulo-1">{{$topico->titulo}}</H5>
                                <p class="texto-1 mb-0">{{$topico->descricao}}</p>
                                <small class="texto "> {{$topico->user->u_nome}} {{\Carbon\Carbon::parse($topico->data_hora)->diffForHumans()}} </small>

                            </div>
                        </div>

                        @foreach($comentarios as $comentario)
                        <div class="row mt-2">
                            <div class="col-12 bg-white shadow p-3">
                                <p class="texto-1 mb-0">{{$comentario->comentario}}</p>
                                <small class="texto "> {{$comentario->user->u_nome}} {{\Carbon\Carbon::parse($comentario->data_hora)->diffForHumans()}} </small>
                            </div>
                        </div>
                        @endforeach

                    </div>

                    <form class="row" method="post" action="/forum/topico/{{$topico->id}}">
                        @csrf
                        <div class="col-12 bg-white shadow mt-2 mb-4 p-3">
                            <div class="form">
                                <textarea name="comentario" class="form-control bg-body-secondary" style="min-height: 80px;
                          " placeholder="Escreva aqui o seu comentário..." id="floatingTextarea"></textarea>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="mt-3 btn btn-sm btn-primary">Enviar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

@endsection