@extends('master')

@section('title')
Adicionar fornecedor
@endsection

@section('content')

<!--main content-->
<div class="row mt-4">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                Funcionarios > Alterar fornecedor
                <a href="{{@url()->previous()}}" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class="row">
            
            <div class="col-12 mt-2 text-center">
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
                <div class="row _navbar text-white d-flex justify-content-center rounded-2 m-1 p-5">
                    <div class="col-md-5 d-flex p-5">
                        <form class="row g-2" method="post" action="/fornecedores/alterar/{{$fornecedor->id}}">
                            @csrf
                            <div class="col-12">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-12">
                                <input type="text" name="nome" class="form-control" id="inputName" placeholder="Nome fornecedor" value='{{$fornecedor->nome}}' />
                            </div>

                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-12">
                                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="Email do fornecedor" value='{{$fornecedor->email}}' />
                            </div>

                            <div class="col-12">
                                <label for="inputTel" class="form-label">Contacto :</label>
                            </div>

                            <div class="col-12">
                                <input type="tel" name="contacto" class="form-control" id="inputNumber" placeholder="Contacto do fornecedor" value='{{$fornecedor->contacto}}' />
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