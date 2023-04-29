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
                <p>Funcionarios > Adicionar matéria-prima</p>
                <a href="/materia-prima" class="btn btn-primary">Voltar</a>
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
                        <form class="row ">
                            <div class="col-10">

                                <input type="email" class="form-control" placeholder="Familia">

                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse2">
                <div class="col-12 mt-1">
                    <div class="_navbar p-4 rounded-2">
                        <form class="row  ">
                            <div class="col-10">

                                <input type="email" class="form-control" placeholder="Sub-familia">

                            </div>
                            <div class="col-2">
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

                        <form class="row g-2" method="post" action="/materia-prima/alterar/{{$materia_prima->id}}">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="col-sm-2 col-form-label">Designação</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="designacao" class="form-control" placeholder="" value='@if($materia_prima->designacao != null){{$materia_prima->designacao }}@endif' />
                            </div>


                            <div class="col-3">
                                <label class="col-sm-2 col-form-label">Familia
                                </label>
                            </div>
                            <div class="col-5">
                                <select class="form-select" name="familia">
                                    <option value="1" selected>Tringo</option>
                                    <option>...</option>
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
                                    <option value="2" >Tringo 2</option>
                                    <option value="1" >Tringo 1</option>
                                    <option>...</option>
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
                                <input type="text" name="codigo" class="form-control" value='@if($materia_prima->codigo != null){{$materia_prima->codigo }}@endif' />
                            </div>

                            <div class="col-3">
                                <label for="inputTel"  class="col-sm-2 col-form-label" >Concentração </label>
                            </div>

                            <div class="col-2">
                                <input type="float" name="concentracao" class="form-control" value='@if($materia_prima->concentracao != null){{$materia_prima->concentracao }}@endif' />
                            </div>

                            <div class="col-7  d-flex align-items-center ">
                                %
                            </div>

                            <div class="col-3  d-flex align-items-center">
                                Principio ativo
                            </div>
                            <div class="col-9">
                                <input type="text" name="principio_activo" class="form-control" value='@if($materia_prima->principio_activo != null){{$materia_prima->principio_activo }}@endif'/>
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