@extends('master')

@section('title')
Adicionar Materia-prima
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between align-items-center _text">
                Matéria-prima > Adicionar matéria-prima
                <a href="/materia-prima" class="btn btn-primary btn-sm">{{__('global.back')}}</a>
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
                    <div class="bg-white shadow p-3 m-1">
                        <form class="row " action="/materia-prima/adicionar/familia" method="post">
                            @csrf
                            <div class="col-12 d-flex justify-content-center align-items-center gap-2">
                                <input type="text" name="familia" class="bg-body-secondary form-control form-control-sm w-25  " placeholder="{{__('global.family')}}">
                                <button type="submit" class="btn btn-sm btn-primary">{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="collapse" id="collapse2">
                <div class="col-12 mt-1">
                    <div class="bg-white shadow p-3 m-1">
                        <form class="row " action="/materia-prima/adicionar/subfamilia" method="post">
                            @csrf
                            <div class="col-12 d-flex justify-content-center align-items-center gap-2">
                                <input type="text" name="subfamilia" class="bg-body-secondary  form-control form-control-sm w-25  " placeholder="{{__('global.sub-family')}}">
                                <button type="submit" class="btn btn-sm btn-primary">{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="collapse" id="collapse3">
                <div class="col-12 mt-1">
                    <div class="bg-white shadow p-3 m-1">
                        <form class="row " action="/materia-prima/adicionar/codigo" method="post">
                            @csrf
                            <div class="col-12 d-flex justify-content-center align-items-center gap-2">
                                <input type="text" name="codigo" class="bg-body-secondary  form-control form-control-sm w-25  " placeholder="{{__('global.code')}}">
                                <input type="text" name="principio_ativo" class="bg-body-secondary  form-control form-control-sm w-25  " placeholder="{{__('global.active-ingredient')}}">
                                <button type="submit" class="btn btn-sm btn-primary">{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bg-white shadow p-3 m-1">
            <div class="col-12 ">
                <div class="row d-flex justify-content-center _text ">
                    <div class="col-7 d-flex mt-5 p-4">

                        <form class="row g-2" method="post" action="/materia-prima/adicionar">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="col-sm-2 col-form-label">{{__('global.designation')}}</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="designacao" class="form-control bg-body-secondary " placeholder="" value='{{old("designacao")}}' />
                            </div>


                            <div class="col-3">
                                <label class="col-sm-2 col-form-label">{{__('global.family')}}
                                </label>
                            </div>
                            <div class="col-5">
                                <select class="form-select bg-body-secondary " name="familia">
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

                            <div class="col-3 ">
                                <label class="col-sm-2 w-100 col-form-label"> {{__('global.sub-family')}}
                                </label>
                            </div>
                            <div class="col-5">
                                <select name="subfamilia" class="form-select bg-body-secondary ">
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
                            {{__('global.european-code')}}
                            </div>

                            <div class="col-5">
                                <select name="codigo" class="form-select bg-body-secondary ">
                                    @foreach($codigo as $codig)
                                    <option value="{{$codig->id}}">{{$codig->codigo}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse2">
                                    +
                                </button>
                            </div>
                            <div class="col-3"></div>
                            <div class="col-3">
                                <label for="inputTel" class="col-sm-2 col-form-label">{{__('global.concentration')}}</label>
                            </div>

                            <div class="col-2">
                                <input type="float" name="concentracao" class="form-control bg-body-secondary " value='{{old("concentracao")}}' />
                            </div>

                            <div class="col-7  d-flex align-items-center ">
                                %
                            </div>


                            <div class="col-12 mt-4 mb-4 text-end">
                                <button type="submit" class="btn btn-primary">
                                {{__('global.save')}}
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