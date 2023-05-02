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
                <div class="row bg-white shadow">
                    <div class="col-12 p-4">
                        <h4>Categorias</h4>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <p>Familia 1</p>
                            <p class="me-4">5</p>
                        </div>

                        <div class="d-flex justify-content-between">
                            <p>Familia 1</p>
                            <p class="me-4">5</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-8 ">

                <div class="row d-flex align-items-center bg-white shadow p-1">
                    <div class="col-9">
                        <button class="btn btn-sm btn-success"> Start New Topic</button>
                    </div>
                    <div class="col-3">
                        <form class="d-flex" role="search">
                            <input class="form-control form-control-sm bg-body-tertiary me-2" type="search" placeholder="Pesquisar" aria-label="Search">
                            <button class="btn btn-sm rounded-5 btn-success" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg></button>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 bg-white shadow mt-2 p-4">
                        <H4>Lorem ipsum dolor sit amet consectetur adipisicing elit.</H4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sequi reiciendis ipsa sit consectetur nostrum minima sed quae nam aliquam, repudiandae voluptatum, ipsum quasi minus hic laborum optio atque molestias debitis.</p>

                        <div class="text-end d-flex justify-content-between">
                            <small> Joaquim Lobo at 20 min</small>
                            <button class="btn btn-sm btn-success"> See more </button>
                        </div>
                    </div>
                </div>

                <div class="row m-1 ">

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