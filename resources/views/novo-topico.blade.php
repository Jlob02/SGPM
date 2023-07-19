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

                <div class="row mb-0 text-center">
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