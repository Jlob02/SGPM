@extends('master')

@section('title')
    Empresas
@endsection

@section('content')

<!--main content-->
<div class="row mt-4">
    <div class="col-1">

    </div>
    <div class="col-10">
        <div class="row">
            <div class="row">
                <div class="col-12 m-1 ">
                    <a href="/adicionar-empresa" class="btn btn-primary">Adicionar empresa</a>
                </div>
            </div>
            <div class="col-12">
                <div class="row _navbar text-white d-flex  align-items-center rounded-top-2 m-1 p-2">

                    <div class="col-8 d-flex align-items-center text-white">
                        Mostrar
                        <div class="me-2 ms-2">
                            <select class="form-select-sm">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </div>
                        Resultados
                    </div>
                    <div class="col-4">
                        <form class="d-flex" role="search">
                            <input class="form-control form-control-sm me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row p-1 _list">
                    <div class="col-12 ">
                        <table class=" table-sm table table-hover">
                            <tr class="text-start ps-2">
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Contacto</th>
                                <th>Nome do responsavel</th>
                                <th>Localidade</th>
                                <th>Pais</th>
                                <th>Estado</th>
                                <th>Opções</th>
                            </tr>
                            <tbody class="table-group-divider">
                            @foreach($empresas as $empresa)
                            <tr>
                                <td class="p-1">{{$empresa->nome}}</td>
                                <td class="p-1">{{$empresa->email}}</td>
                                <td class="p-1">{{$empresa->contacto}}</td>
                                <td class="p-1">{{$empresa->nome_responsavel}}</td>
                                <td class="p-1">{{$empresa->localidade}}</td>
                                <td class="p-1">{{$empresa->pais}}</td>
                                <td class=""><a href="#" class="btn text-white rounded-3 btn-sm btn-success">ativo</a></td>
                                <td class=""> <a href="#" class="btn text-white rounded-3 btn-sm btn-success">alterar</a> <a href="" class="btn text-white btn-sm rounded-3 btn-danger ">apagar</a></td>
                            </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
                <div class="row _navbar rounded-bottom-2 m-1 ">
                    <div class="col-12 d-flex align-items-center justify-content-end">

                        <ul class="pagination mb-0 p-1">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>


@endsection