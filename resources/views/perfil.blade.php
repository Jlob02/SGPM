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
                <div class="row d-flex justify-content-center  bg-white shadow m-1 p-2">
                    <div class="col-md-10  p-5">
                        <h3>Nome : {{$user->u_nome}}</h3> <br>
                        <h4>Email : {{$user->email}}</h4> <br>
                        <h4>Contacto : {{$user->u_contacto}}</h4> <br>

                        <h4>Tipo : @if($user->u_tipo == 1) Administrador @endif @if($user->u_tipo == 2) Administrador de empresa @endif @if($user->u_tipo == 3) Funcionário @endif </h4> <br>
                        <h4>Empresa :{{$user->empresa->nome}} </h4> <br>
                        <h4>Função : {{$user->funcao->funcao}}</h4> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

<!-- fim main content-->

@endsection