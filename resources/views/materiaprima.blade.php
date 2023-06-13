@extends('master')

@section('title')
Empresas
@endsection

@section('content')

<!--main content-->
<div class="row bg-white">
    <div class="col-1"></div>
    <div class="col-10">
        <div class="row mt-3">
            <div class="col-12 d-flex justify-content-between">
                Materia-prima >
                <a href="{{@url()->previous()}}" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class=" row">
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

                <div class="row">

                    <div class="col-8">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-1 mb-1 border-bottom">
                            <h5 class="titulo-1">@isset($materiaprima) {{$materiaprima->designacao}} @endisset</h5>
                            <div class="btn-toolbar  me-4">
                                <select class="form-select bg-body-secondary form-select-sm ">
                                    <option selected>1 mês</option>
                                    <option value="1">3 meses</option>
                                    <option value="2">6 meses</option>
                                    <option value="3">1 ano</option>
                                </select>
                            </div>
                        </div>
                        <canvas class="" id="myChart" width="900" height="400px"></canvas>
                    </div>

                    <div class="col-4">
                        <h5 class="titulo-1 p-2">Notícias</h5>

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
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        Export CSV
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            @isset($precos)
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Pais</th>
                                        <th>Empresa</th>
                                        <th>Fornecedor</th>
                                        <th>Quant. minima</th>
                                        <th>Data de inicio</th>
                                        <th>Data de fim</th>
                                        <th class="d-flex">preco <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                                                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                                            </svg>
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