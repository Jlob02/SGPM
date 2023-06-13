@extends('master')

@section('title')
Empresas
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row m-1 p-2">
            <div class="col-12 d-flex justify-content-between align-items-center _text">
                Funcionarios > Adicionar funcionario
                <a href="/funcionarios" class="btn btn-primary btn-sm">Voltar</a>
            </div>

            <div class="col-12 bg-white shadow ">
                <div class="collapse" id="collapseExample">
                    <form class="row" action="/funcionarios/adicionar/funcao" method="post">
                        @csrf
                        <div class="col-12 d-flex justify-content-center align-items-center gap-2 p-2 ">
                            <input type="text" name="funcao" class="bg-body-secondary form-control form-control-sm w-25  " placeholder="Função">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12 mb-0 mt-1 text-center">
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
        </div>
        <div class="row m-1 ">
            <div class="col-12">
                <div class="row  d-flex justify-content-center bg-white shadow  p-1 _text">
                    <div class="col-md-10 d-flex p-4">
                        <form class="row g-2" method="post" action="/funcionarios/adicionar">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nome" class="form-control bg-body-secondary" id="inputName" placeholder="John Doe" value='{{old("nome")}}' />
                            </div>
                            <div class="col-3">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-9">
                                <input type="email" name="email" class="form-control bg-body-secondary" id="inputEmail4" placeholder="exemplo@email.com" value='{{old("email")}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputPassword4" class="form-label">Password :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="password" name="password" class="form-control bg-body-secondary" id="inputPassword4" value='{{old("password")}}' />
                            </div>
                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputTel" class="form-label">Contacto :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="tel" name="contacto" placeholder="910000000" class="bg-body-secondary form-control" id="inputTel" value='{{old("contacto")}}' />
                            </div>

                            <div class="col-4"></div>
                            <div class="col-3 ">
                                <label for="inputState" class="form-label">Função :
                                </label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputStat" name="funcao" class="form-select bg-body-secondary">
                                    @foreach($funcoes as $funcao)
                                    <option value="{{$funcao->id}}">{{$funcao->funcao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                    +
                                </button>
                            </div>

                            @if(Auth::User()->u_tipo == 1)
                            <div class="col-3"></div>
                            <div class="col-3">
                                <label for="inputState" class="form-label">Tipo :</label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputSta" name="tipo" class="form-select bg-body-secondary">
                                    <option value="1" selected>Administrador</option>
                                    <option value="2">Administrador de empresa</option>
                                    <option value="3">Funcionário</option>
                                </select>
                            </div>


                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputState" class="form-label">Empresa :
                                </label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputState" name="empresa" class="form-select bg-body-secondary">
                                    @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{$empresa->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-1">
                                <a class="btn btn-primary" type="button" href="/empresas/adicionar">
                                    +
                                </a>
                            </div>

                            @else
                            <div class="col-3"></div>
                            <div class="col-3">
                                <label for="inputState" class="form-label">Tipo :</label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputSta" name="tipo" class="form-select bg-body-secondary ">
                                    <option value="3" selected>Funcionário</option>
                                </select>
                            </div>
                            <div class="col-1">

                            </div>

                            <div class="col-3"></div>

                            <div class="col-3">
                                <label for="inputState" class="form-label">Empresa :
                                </label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputState" name="empresa" class="form-select bg-body-secondary">
                                    <option value="{{Auth::User()->empresa->id}}" selected>{{Auth::User()->empresa->nome}}</option>
                                </select>
                            </div>
                            @endif
                            <div class="col-12 mt-4 text-end">
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