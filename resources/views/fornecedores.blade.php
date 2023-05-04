@extends('master')

@section('title')
Fornecedores
@endsection

@section('content')

<!--main content-->
<div class="row mt-1">
    <div class="col-1">
    </div>
    <div class="col-10">

        <div class="row bg-white shadow m-1 p-1">
            <div class="col-12">
                <a href="/fornecedores/adicionar" class="btn _nav btn-sm">Adicionar Fornecedor</a>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="row d-flex  align-items-center bg-white shadow m-1 p-1">
                    <div class="col-9 d-flex align-items-center">
                        Mostrar
                        <form class="me-2 ms-2">
                            <select class="form-select form-select-sm bg-body-secondary">
                                <option selected>15</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </form>

                        Resultados
                    </div>
                    <div class="col-3">
                        <form class="d-flex" role="search" action="/fornecedores" method="get">
                            <input class="form-control form-control-sm me-2 bg-body-secondary" name="search" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" id="dialog">

                        </div>
                    </div>
                </div>

                <div class="row bg-white shadow m-1 p-1 _list">
                    <div class="col-12 ">
                        <table class="table table-sm table-striped table-hover">
                            <thead>
                                <tr class="text-start ps-2">
                                    @if(Auth::user()->u_tipo == 1)
                                    <th>Empresa</th>
                                    @endif
                                    <th>Fornecedor</th>
                                    <th>Email</th>
                                    <th>Telemovel</th>
                                    <th>Opções</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                @foreach($fornecedores as $fornecedor)
                                <tr>
                                    @if(Auth::user()->u_tipo == 1)
                                    <td class="p-1">{{$fornecedor->empresa->nome}}</td>
                                    @endif
                                    <td class="p-1">{{$fornecedor->nome}}</td>
                                    <td class="p-1">{{$fornecedor->email}}</td>
                                    <td class="p-1">{{$fornecedor->contacto}}</td>
                                    <td class="d-flex justify-content-around">

                                        <form action="/fornecedores/alterar/{{$fornecedor->id}}" method="get">
                                            @csrf
                                            <button class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg></button>
                                        </form>

                                        <button onclick='dialog("{{$fornecedor->id}}","{{$fornecedor->nome}}")' class=" border border-0 bg-transparent" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-trash" viewBox="0 0 16 16" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z" />
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z" />
                                            </svg></button>

                                    </td>
                                </tr>
                                @endforeach
                        </table>
                    </div>
                </div>
                <div class="row bg-white shadow m-1 p-1">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                        @if ($fornecedores->links()->paginator->hasPages())
                        <ul class="pagination mb-0">
                            {{ $fornecedores->onEachSide(3)->links() }}
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
        <form action="/fornecedores/apagar/` + id + `" method="post">
            @csrf
             @method('DELETE')
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmação</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Tem a certeza que quer aparagr o fornecedor ` + nome + ` ?
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