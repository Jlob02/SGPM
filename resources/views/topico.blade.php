@extends('master')

@section('title')
Tópico
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" id="dialog">

        </div>
    </div>

    <div class="col-1"></div>

    <div class="col-10">
        <div class="row m-1 gap-3">
            <div class="col-3 ">
                <div class="row bg-white shadow" style="height: 250px;">
                    <div class="col-12 p-4">
                        <h6 class="titulo-1">{{__('global.category')}}</h6>
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

                <div class="row m-1 d-flex align-items-center bg-white shadow p-1">
                    <div class="col-8">
                        <a href="/forum/novo-topico" class="btn btn-sm btn-success">{{__('global.create-new-topic')}}</a>
                    </div>
                    <div class="col-4">
                    </div>
                </div>

                <div class="row m-0">
                            <div class="col-12 rounded bg-white shadow mt-2 mb-2 p-4">
                                <H5 class="titulo-1">{{$topico->titulo}}</H5>
                                <p class="texto-1 mb-0">{{$topico->descricao}}</p>
                                <small class="texto "> {{$topico->user->u_nome}} {{\Carbon\Carbon::parse($topico->data_hora)->diffForHumans()}} </small>
                            </div>
                        </div>
                <div class="row ">
                    <div class="col-12 _list1">
                       
                        @foreach($comentarios as $comentario)
                        <div class="row">
                            @if($comentario->user->id == Auth::user()->id)
                            <div class="col-12 mt-2 d-flex justify-content-end">
                                <div class="toast d-block" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">{{$comentario->user->u_nome}}</strong>
                                        <small> {{\Carbon\Carbon::parse($comentario->data_hora)->diffForHumans()}} <button onclick='dialog("{{$comentario->id}}")' data-bs-toggle="tooltip" title="Remover" class=" border border-0 bg-transparent" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                                </svg></button></small>
                                    </div>
                                    <div class="toast-body">
                                        {{$comentario->comentario}}

                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-12 mt-2 d-flex justify-content-start">
                                <div class="toast d-block" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="toast-header">
                                        <strong class="me-auto">{{$comentario->user->u_nome}}</strong>
                                        <small> {{\Carbon\Carbon::parse($comentario->data_hora)->diffForHumans()}}</small>
                                    </div>
                                    <div class="toast-body">
                                        {{$comentario->comentario}}

                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <form class="row m-1" method="post" action="/forum/topico/{{$topico->id}}">
                        @csrf
                        <div class="col-12 rounded bg-white shadow mt-3 mb-4 p-3">
                            <div class="form">
                                <textarea name="comentario" class="form-control bg-body-secondary" style="min-height: 40px;
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

<script>
    function dialog(id) {

        document.getElementById("dialog").innerHTML = `
<form action="/forum/comentario/` + id + `" method="post">
    @csrf
     @method('DELETE')
        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem a certeza que quer apagar o comentário?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Apagar</button>
                            </div>
        </div>
</form>`;

    };
</script>

@endsection