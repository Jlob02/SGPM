@extends('master')

@section('title')
Empresas
@endsection

@section('content')

<!--main content-->
<div class="row mt-4">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <p>Funcionarios > Adicionar funcionario</p>
                <a href="/funcionarios" class="btn btn-primary">Voltar</a>
            </div>
        </div>
        <div class=" row">
            <div class="col-12  mt-1 mb-1">
                <div class="collapse" id="collapseExample">
                    <div class=" p-4 _navbar rounded-2  card-body">
                        <form class="row" action="/funcionarios/adicionar/funcao" method="post">
                            @csrf
                            <div class="col-3"></div>

                            <div class="col-4">
                                <input type="text" name="funcao" class="form-control" placeholder="Função">
                            </div>

                            <div class="col-2">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center">
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
            <div class="col-12">
                <div class="row _navbar text-white d-flex justify-content-center rounded-2 m-1 p-2">
                    <div class="col-md-10 d-flex p-4">
                        <form class="row g-2" method="post" action="/funcionarios/adicionar">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nome" class="form-control" id="inputName" placeholder="John Doe" value='{{old("nome")}}' />
                            </div>
                            <div class="col-3">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-9">
                                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="exemplo@email.com" value='{{old("email")}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputPassword4" class="form-label">Password :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="password" name="password" class="form-control" id="inputPassword4" value='{{old("password")}}' />
                            </div>
                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputTel" class="form-label">Contacto :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="tel" name="contacto" placeholder="910000000" class="form-control" id="inputTel" value='{{old("contacto")}}' />
                            </div>

                            <div class="col-4"></div>
                            <div class="col-3 ">
                                <label for="inputState" class="form-label">Função :
                                </label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputStat" name="funcao" class="form-select">
                                    @foreach($funcoes as $funcao)
                                    <option value="{{$funcao->id}}" selected>{{$funcao->funcao}}</option>
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
                                <select id="inputSta" name="tipo" class="form-select">
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
                                <select id="inputState" name="empresa" class="form-select">
                                    @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}" selected>{{$empresa->nome}}</option>
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
                                <select id="inputSta" name="tipo" class="form-select " disabled>
                                    <option value="1" selected>Administrador</option>
                                    <option value="2">Administrador de empresa</option>
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
                                <select id="inputState" name="empresa" class="form-select" disabled>
                                    <option value="1" selected>DIN-1</option>
                                    <option value="2">DIN-2</option>
                                    <option value="3">DIN-3</option>
                                    <option value="4">DIN-4</option>
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