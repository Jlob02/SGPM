@extends('master')

@section('title')
Fórum
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
        <div class="row m-1 gap-4">
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

                <div class="row d-flex align-items-center bg-white shadow p-1">
                    <div class="col-8">
                        <a href="/forum/novo-topico" class="btn btn-sm btn-success">{{__('global.create-new-topic')}}</a>
                    </div>
                    <div class="col-4">
                        <form class="d-flex" role="search" action="/forum" method="get">
                            <input name="search" class="form-control form-control-sm bg-body-secondary me-2" type="search" placeholder="{{__('global.search')}}" aria-label="Search">
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
                            <div class="col-12 rounded bg-white mt-2 shadow p-4">
                                <h5 class="">{{$topico->titulo}}</h5>
                                <p class="texto-1 ">{{$topico->descricao}}</p>
                                <div class="text-end d-flex justify-content-between">
                                    <small class="texto "> {{$topico->user->u_nome}} {{\Carbon\Carbon::parse($topico->data_hora)->diffForHumans()}} </small>
                                    <div class="">
                                        @if($topico->user->id == Auth::user()->id)
                                        <button onclick='dialog("{{$topico->id}}")' data-bs-toggle="tooltip" title="Remover" class=" border border-0 bg-transparent" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button> @endif
                                        <a href="/forum/topico/{{$topico->id}}" class="btn texto btn-sm btn-success">{{__('global.see-more')}}</a>
                                    </div>
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

<script>
    function dialog(id) {

        document.getElementById("dialog").innerHTML = `
<form action="/forum/topico/` + id + `" method="post">
    @csrf
     @method('DELETE')
        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Tem a certeza que quer apagar o tópico?
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