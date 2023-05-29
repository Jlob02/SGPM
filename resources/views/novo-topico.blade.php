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

                <div class="row mt-2 mb-0 text-center">
                    @if($errors->any())
                    <div class="alert alert-warning" role="alert">
                        {{$errors->first()}}
                    </div>
                    @endif
                    @if (\Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                    @endif
                </div>

                <form class="row bg-white shadow p-4" method="post" action="/forum/novo-topico">
                    @csrf
                    <div class="col-12">
                        <label for="formGroupExampleInput" class="form-label">Tópico</label>
                        <input name="titulo" type="text" class="form-control bg-body-secondary " id="formGroupExampleInput" placeholder="Título" />
                    </div>
                    <div class="col-5">
                        <label for="inputState" class="form-label mt-2">Familia</label>
                        <select name="familia" id="inputState" class="form-select bg-body-secondary ">
                            <option selected>Selecionar</option>
                            @foreach($familias as $familia)
                            <option value="{{$familia->id}}">{{$familia->familia}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-7"></div>
                    <div class="col-12 mt-3">
                        <div class="form">
                            <textarea name="descricao" class="form-control bg-body-secondary " style="min-height: 150px" placeholder="Descrição..." id="floatingTextarea"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="mt-3 btn btn-sm btn-primary">
                                Criar tópico
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="col-1"></div>
</div>

@endsection