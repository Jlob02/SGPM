@extends('master')

@section('title')
Alterar funcionário
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row p-2">
            <div class="col-12 d-flex justify-content-between align-items-center _text">
                Funcionarios > alterar funcionário >
                @if($user->u_nome != null)
                {{$user->u_nome}}
                @endif

                <a href="{{@url()->previous()}}" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class="row">
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
                <div class="row d-flex justify-content-center bg-white shadow m-1 _text p-2">
                    <div class="col-md-10 d-flex p-4">
                        <form class="row g-2" method="post" action="/perfil/alterar/{{$user->id}}">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" v name="nome" class="form-control bg-body-secondary" id="inputName" placeholder="John Doe" value='@if($user->u_nome != null){{$user->u_nome}}@endif' />
                            </div>
                            <div class="col-3">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-9">
                                <input type="email" name="email" class="form-control bg-body-secondary" id="inputEmail4" placeholder="exemplo@email.com" value='{{$user->email}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputTel"  class="form-label">Contacto :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="tel" name="contacto" class="form-control bg-body-secondary" id="inputTel" value='@if($user->u_contacto != null){{$user->u_contacto}}@endif' />
                            </div>

                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputPassword4"  class="form-label">Password :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="password" name="password" class="form-control bg-body-secondary" id="inputPassword4" value='{{old("password")}}' />
                            </div>
                            <div class="col-4"></div>
                            <div class="col-3">
                                <label for="inputPassword4" class="form-label">New password :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="password" name="new_password" class="form-control bg-body-secondary" id="inputPassword4" value='{{old("password")}}' />
                            </div>
                            <div class="col-4"></div>
                            <div class="col-3 ">
                                <label for="inputState" class="form-label">Função :
                                </label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputStat" name="funcao" class="form-select bg-body-secondary" disabled>
                                    @foreach($funcoes as $funcao)
                                    <option value="{{$funcao->id}}">{{$funcao->funcao}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                
                            </div>
                            <div class="col-3"></div>


                            <div class="col-3">
                                <label for="inputState" class="form-label">Tipo :</label>
                            </div>
                            <div class="col-md-5">
                                <select id="inputSta" name="tipo" class="form-select bg-body-secondary" disabled>
                                    <option value="1" selected>Administrador do sistema</option>
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
                                <select id="inputState" name="empresa" class="form-select bg-body-secondary" disabled>
                                    @foreach($empresas as $empresa)
                                    <option value="{{$empresa->id}}">{{$empresa->nome}}</option>
                                    @endforeach
                                </select>
                            </div>

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