@extends('master')

@section('title')
Adicionar Materia-prima
@endsection

@section('content')

<!--main content-->
<div class="row mt-4">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                Funcionarios > Adicionar matéria-prima
                <a href="{{@url()->previous()}}" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class="row ">

            <div class="col-12 mt-1 mb-1 text-center">
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
            <div class="collapse" id="collapse1">
                <div class="col-12 ">
                    <div class="_navbar p-4 rounded-2">
                        <form class="row " action="/materia-prima/adicionar/familia" method="post">
                            @csrf
                            <div class="col-12 d-flex justify-content-center align-items-cente gap-2">
                                <input type="text" name="familia" class="form-control form-control-sm w-25  " placeholder="Familia">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse2">
                <div class="col-12 mt-1">
                    <div class="_navbar p-4 rounded-2">
                        <form class="row " action="/materia-prima/adicionar/subfamilia" method="post">
                            @csrf
                            <div class="col-12 d-flex justify-content-center align-items-cente gap-2">
                                <input type="text" name="subfamilia" class="form-control form-control-sm w-25  " placeholder="Sub-Familia">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row m-1">

            <div class="col-12 ">
                <div class="row _navbar text-white d-flex justify-content-center rounded-2">
                    <div class="col-7 d-flex mt-5 p-4">

                        <form class="row g-2" method="post" action="/materia-prima/adicionar">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Designação</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="designacao" class="form-control" placeholder="" value='{{old("designacao")}}' />
                            </div>


                            <div class="col-3">
                                <label class="col-sm-2 col-form-label">Familia
                                </label>
                            </div>
                            <div class="col-5">
                                <select class="form-select" name="familia">
                                    @foreach($familias as $familia)
                                    <option value="{{$familia->id}}">{{$familia->familia}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
                                    +
                                </button>
                            </div>
                            <div class="col-3"></div>

                            <div class="col-3">
                                <label class="col-sm-2  col-form-label"> SubFamilia
                                </label>
                            </div>
                            <div class="col-5">
                                <select name="subfamilia" class="form-select">
                                    @foreach($subfamilias as $subfamilia)
                                    <option value="{{$subfamilia->id}}">{{$subfamilia->subfamilia}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    +
                                </button>
                            </div>
                            <div class="col-3"></div>

                            <div class="col-3  d-flex align-items-center">
                                Código Europeu
                            </div>
                            <div class="col-9">
                                <input type="text" name="codigo" class="form-control" value='{{old("codigo")}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputTel" class="col-sm-2 col-form-label">Concentração </label>
                            </div>

                            <div class="col-2">
                                <input type="float" name="concentracao" class="form-control" value='{{old("concentracao")}}' />
                            </div>

                            <div class="col-7  d-flex align-items-center ">
                                %
                            </div>

                            <div class="col-3  d-flex align-items-center">
                                Principio ativo
                            </div>
                            <div class="col-9">
                                <input type="text" name="principio_activo" class="form-control" value='{{old("principio_activo")}}' />
                            </div>

                            <div class="col-12 mt-4 mb-4 text-end">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <div class="col-1"></div>
</div>

<!-- fim main content-->

@endsection