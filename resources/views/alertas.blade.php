@extends('master')

@section('title')
Alerta
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
            <div class="col-12 ms-0 m-1 p-2 mt-0 ">
                <a href="/materia-prima" class="btn btn-primary btn-sm _nav">Matérias-primas</a>
                <a href="/materia-prima/precos" class="btn btn-primary btn-sm _nav">Preços</a>
                <a href="/materia-prima/alertas" class="btn btn-primary btn-sm _nav">Alertas</a>
            </div>

            <div class="col-12">
                <div class="row _navbar  d-flex align-items-center bg-white shadow p-2">
                    <div class="col-9 d-flex align-items-center">
                       
                    </div>

                    <div class="col-3 ">
                        <form class="d-flex" role="search" action="/materia-prima/alertas" method="get">
                            <input name="search" class="form-control form-control-sm me-2 bg-body-secondary" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success " type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row mt-2 _list ">
                    <div class="col-12 bg-white shadow">
                        <table class="table table-striped table-sm table-hover">
                            <thead>
                                <tr class="text-start">
                                    <th>Matéria-prima</th>
                                    <th>Preço minimo</th>
                                    <th>Preço maximo</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($alertas as $alerta)
                                <tr>
                                    <td>{{$alerta->materiaprima->designacao}}</td>
                                    <td>{{$alerta->preco_minimo}}</td>
                                    <td>{{$alerta->preco_maximo}}</td>
                                
                                    <td class=" d-flex justify-content-around">

                                        <button onclick='dialog("{{$alerta->id}}","{{$alerta->materiaprima->designacao}}")' class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button>
                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
                <div class="row bg-white shadow mt-2 p-1">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        @isset($alertas)
                        @if ($alertas->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $alertas->onEachSide(3)->links() }}
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

    function dialog(id, nome) {
        document.getElementById("dialog").innerHTML = `
        <form action="/materia-prima/apagar/alerta/` + id + `" method="post">
            @csrf
             @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                                        Tem a certeza que quer apagar o alerta para a materia-prima ` + nome + `?
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