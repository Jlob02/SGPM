@extends('master')

@section('title')
Home
@endsection

@section('content')

<!--main content-->
<div class="row mt-4">
    <div class="col-1">
    </div>
    <div class="col-10">
        <div class="row">
            <div class="col-2">
                <div class="row  ">
                    <div class="col-12 rounded-top-2 m-1 p-1 _navbar text-white p-1 mt-1">
                        <h4 class="ms-2">Filtros</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 bg-body-tertiary m-1 p-2 d-flex justify-content-center rounded-bottom-2 _filtros">

                        <form class="row">
                            <div class="col-12">
                                <div class="btn-group bg-white mb-2 w-100">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Empresa</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="btn-group bg-white mb-2 w-100">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Pais</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="btn-group bg-white mb-2 w-100">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Familia</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 ">
                                <div class="btn-group bg-white mb-2 w-100">
                                    <select class="form-select form-select-sm" aria-label="Default select example">
                                        <option selected>Sub-familia</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12  mb-3 ">
                                <input class="form-control form-control-sm" type="date" placeholder="Default input">
                            </div>
                            <div class="col-12 mb-3 text-center">
                                <button type="submit" class="btn btn-primary w-50">Filtrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-10">
                <div class="row _navbar rounded-top-2 m-1 p-1">
                    <div class="col-9 d-flex align-items-center text-white">
                        Mostrar
                        <div class="me-2 ms-2">
                            <select class="form-select-sm ">
                                <option selected>10</option>
                                <option value="1">20</option>
                                <option value="2">30</option>
                                <option value="3">40</option>
                            </select>
                        </div>

                        Resultados
                    </div>
                    <div class="col-3">
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
                        @foreach($precos as $preco)
                        <a href="materia-prima/{{$preco->id}}" class="row m-1 d-flex align-items-center _list_item">
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
                                        PREÇO : {{$preco->preco}}
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
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="red" class="bi bi-triangle-fill" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M7.022 1.566a1.13 1.13 0 0 1 1.96 0l6.857 11.667c.457.778-.092 1.767-.98 1.767H1.144c-.889 0-1.437-.99-.98-1.767L7.022 1.566z" />
                                </svg>
                            </div>
                        </a>
                        @endforeach

                        <a href="#" class="row m-1 d-flex align-items-center _list_item">
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
                <div class="row _navbar rounded-bottom-2 m-1 ">
                    <div class="col-12 d-flex align-items-center justify-content-end">
                    @if ($precos->links()->paginator->hasPages())
                        <ul class="pagination mb-0 p-1">
                            {{ $precos->onEachSide(3)->links() }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

@endsection