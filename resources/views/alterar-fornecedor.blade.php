@extends('master')

@section('title')
Alterar fornecedor
@endsection

@section('content')

<!--main content-->
<div class="row mt-3">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row bg-white shadow m-1 p-2">
            <div class="col-12 d-flex justify-content-between align-items-center _text">
                Fornecedores > Alterar fornecedor
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
                <div class="row d-flex justify-content-center bg-white shadow m-1 _text m-1 p-5">
                    <div class="col-7 d-flex p-5">
                        <form class="row g-1" method="post" action="/fornecedores/alterar/{{$fornecedor->id}}">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nome" class="form-control bg-body-secondary" id="inputName" placeholder="Nome fornecedor" value='{{$fornecedor->nome}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-9">
                                <input type="email" name="email" class="form-control bg-body-secondary" id="inputEmail4" placeholder="Email do fornecedor" value='{{$fornecedor->email}}' />
                            </div>

                            <div class="col-3">
                                <label for="inputTel" class="form-label">País :</label>
                            </div>

                            <div class="col-5">
                                <input type="text" name="pais" class="form-control bg-body-secondary" id="inputNumber" placeholder="País do fornecedor" value='{{$fornecedor->pais}}' />
                            </div>

                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputTel" class="form-label">Contacto :</label>
                            </div>

                            <div class="col-5">
                                <input type="tel" name="contacto" class="form-control bg-body-secondary" id="inputNumber" placeholder="Contacto do fornecedor" value='{{$fornecedor->contacto}}' />
                            </div>

                            <div class="col-4"></div>
    
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