@extends('master')

@section('title')
Matéria-prima
@endsection

@section('content')

<!--main content-->
<div class="row bg-white">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-end">
                <a href="{{@url()->previous()}}" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class=" row">

            <div class="col-12">

                <div class="row">

                    <div class="col-8">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-1 border-bottom">
                            <h4 class="">@isset($materiaprima) {{$materiaprima->designacao}} @endisset</h4>
                            <div class=" me-4 mb-2">
                                <div class="d-flex align-items-center ">
                                    <input  class="me-2 form-control form-control-sm bg-body-secondary" type="date">
                                    a
                                    <input  class="form-control form-control-sm ms-2 bg-body-secondary" type="date">
                                </div>
                            </div>
                        </div>
                        <canvas class="" id="myChart" width="900" height="400px"></canvas>
                    </div>

                    <div class="col-4">
                        <h5 class=" p-2">Tópicos</h5>

                        <div class="row noticias">
                            @isset($topicos)
                            @foreach($topicos as $topico)
                            <hr>
                            <a href="/forum/topico/{{$topico->id}}">
                                <h6 class="mb-1 titulo-2">{{$topico->titulo}}</h6>
                            </a>
                            <p class="texto">{{$topico->descricao}}</p>
                            @endforeach
                            @endisset
                        </div>
                    </div>

                    <div class="col-12 mb-5">
                        <hr>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
                            <h5 class="titulo-1">Tabela de preços</h5>

                            <div class="btn-toolbar mb-1 ">
                                <div class="btn-group me-2">
                                    <a href="/materia-prima/precos/export/{{$materiaprima->codigo->id}}" type="button" class="btn btn-sm btn-outline-secondary">
                                        Export CSV
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            @isset($precos)
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black ">
                                                País
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black">
                                                Empresa
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black">
                                                Fornecedor
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>Quant. Minima</th>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black">
                                                Data de Inicio
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black">
                                                Data de Fim
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="#" class="d-flex align-items-center  justify-content-between text-black">
                                                Preço
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>Unidade</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($precos as $preco)
                                    <tr>
                                        <td>{{$preco->materiaprima->empresa->pais}}</td>
                                        <td>{{$preco->materiaprima->empresa->nome}}</td>
                                        <td>{{$preco->fornecedor->nome}}</td>
                                        <td> @if($preco->quantidade_minima==1)
                                            Camião completo
                                            @endif
                                            @if($preco->quantidade_minima==2)
                                            >= 1 Palete
                                            @endif
                                            @if($preco->quantidade_minima==3)
                                            < 1 Palete @endif @if($preco->quantidade_minima==4)
                                                Não aplicável
                                                @endif
                                        </td>
                                        <td>{{$preco->data_inicio}}</td>
                                        <td>{{$preco->data_fim}}</td>
                                        <td>{{$preco->preco}}</td>
                                        <td>@if($preco->unidade == 1)
                                            Kg
                                            @else
                                            T
                                            @endif</td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById("myChart");
    const month = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Oct",
        "Nov",
        "Dec",
    ];


    const data = JSON.parse('{!! $precos!!}');
    data.reverse();

    var fornecedores = [];
    const labels = [];

    var indexforn = 0;



    for (let index = 0; index < data.length; index++) {


        if (labelExists(data[index].fornecedor.nome)) {

            fornecedores.push({
                'label': data[index].fornecedor.nome,
                'data': [data[index].preco]
            });

            indexforn = fornecedores.length - 1;

        } else {
            fornecedores[indexforn].data.push(data[index].preco);
        }

        for (var i = 0; i < fornecedores.length; i++) {

            if (i != indexforn) {
                fornecedores[i].data.push(fornecedores[i].data[fornecedores[i].data.length - 1]);
            }
        }


        var dateTime = new Date(data[index].created_at);

        var dia = dateTime.getDate();
        var mes = dateTime.getMonth() + 1;
        var ano = dateTime.getFullYear();

        var dataFormatada = dia + "/" + mes + "/" + ano;


        if (!dataExists(dataFormatada)) {
            labels.push(dataFormatada);
        }


    }


    function labelExists(label) {

        for (var i = 0; i < fornecedores.length; i++) {
            if (fornecedores[i].label === label) {
                indexforn = i;
                return false;
            }
        }

        return true;
    }


    function dataExists(datatime) {

        for (var i = 0; i < labels.length; i++) {
            if (labels[i] === datatime) {
                return true;
            }
        }
        return false;
    }



    new Chart(ctx, {
        type: "line",
        data: {
            labels: labels,
            datasets: fornecedores,
        },
        options: {
            scales: {
                y: {
                    type: "linear",
                },
            },
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: "rgb(255, 99, 132)",
                    },
                    position: "bottom",
                },
            },
            elements: {
                point: {
                    pointStyle: false,
                },
                line: {
                    borderJoinStyle: "round",
                },
            },
        },
    });
</script>

<!-- fim main content-->

@endsection