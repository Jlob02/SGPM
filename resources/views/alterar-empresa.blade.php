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
                <p>Funcionarios > Alterar Empresa > @if($empresa->nome != null)
                    {{$empresa->nome}}
                    @endif
                </p>
                <a href="/empresas" class="btn btn-primary">Voltar</a>
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
                <div class="row _navbar text-white d-flex justify-content-center rounded-2 m-1 p-5">
                    <div class="col-md-10 d-flex p-5">
                        <form class="row g-2" method="post" action="/alterar-empresa/{{$empresa->id}}">
                            @csrf
                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nome" class="form-control" id="inputName" placeholder="DIN" value='@if($empresa->nome != null){{$empresa->nome}}@endif' />
                            </div>

                            <div class="col-3">
                                <label for="inputEmail4" class="form-label">Email :
                                </label>
                            </div>
                            <div class="col-9">
                                <input type="email" name="email" class="form-control" id="inputEmail4" placeholder="exemplo@email.com" value='@if($empresa->email != null){{$empresa->email}}@endif' />
                            </div>

                            <div class="col-3">
                                <label for="inputTel" class="form-label">Contacto :</label>
                            </div>

                            <div class="col-md-5">
                                <input type="tel" name="contacto" class="form-control" id="inputNumber" value='@if($empresa->contacto != null){{$empresa->contacto}}@endif' />
                            </div>

                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputName" class="form-label">Nome da pessoa responsavel : </label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="nome_responsavel" class="form-control" id="inputName" placeholder="John Doe" value= '@if($empresa->nome_responsavel != null){{$empresa->nome_responsavel}}@endif' />
                            </div>

                            <div class="col-3">
                                <label for="inputCity" class="form-label">localidade : </label>
                            </div>
                            <div class="col-5">
                                <input type="text" name="localidade" class="form-control" id="inputCity" placeholder="Coimbra" value= '@if($empresa->localidade != null){{$empresa->localidade}}@endif' />
                            </div>
                            <div class="col-4"></div>

                            <div class="col-3">
                                <label for="inputCountry" class="form-label">Pais : </label>
                            </div>
                            <div class="col-5">
                                <input type="text" name="pais" class="form-control" id="inputCountry" placeholder="Portugal" value= '@if($empresa->pais != null){{$empresa->pais}}@endif' />
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