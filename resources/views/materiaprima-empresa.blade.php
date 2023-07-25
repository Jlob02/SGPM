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
                <a href="/materia-prima" class="btn btn-primary btn-sm">Voltar</a>
            </div>
        </div>
        <div class=" row">

            <div class="col-12">

                <div class="row m-1">
                    <div class="col-12 bg-white shadow  p-2">
                        <div class="d-flex align-items-center me-3">
                            <h5 class="m-0 ms-2"> @isset($materiaprima) {{$materiaprima->designacao}} @endisset</h5>
                            <p class="m-0 ms-2 mt-2 texto-1"> @isset($materiaprima) {{$materiaprima->codigo->codigo}} @endisset</p>
                        </div>
                        <div class="d-flex me-3">
                            <p class="m-0 ms-2 texto-1"> @isset($materiaprima) {{$materiaprima->familia->familia}} @endisset</p>
                        </div>
                        <div class="d-flex me-3">
                            <p class="m-0 ms-2 texto-1"> @isset($materiaprima) {{$materiaprima->subfamilia->subfamilia}} @endisset</p>
                        </div>
                        <div class="row p-1">
                            <form class="col-12 d-flex align-items-center" action="/materia-prima/empresa/{{$materiaprima->id}}" method="get">
                                <h5 class="m-0 ms-1 me-2">Mostrar preços de :</h5>
                                <div class=" me-4">
                                    <div class="d-flex align-items-center ">
                                        <input name="data_inicio" class="me-2 form-control form-control-sm btn-outline-secondary" type="date" @isset($data_inicio) value="{{$data_inicio}}" @endisset>
                                        a
                                        <input name="data_fim" class="form-control form-control-sm ms-2 btn-outline-secondary" type="date" @isset($data_inicio) value="{{$data_fim}}" @endisset>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Aplicar</button>
                            </form>
                        </div>
                    </div>

                    <div class="col-12 bg-white shadow mt-2 p-2 ">

                        <canvas class="" id="myChart" width="900" height="300px"></canvas>
                    </div>

                    <div class="col-12 bg-white shadow mt-3 mb-5">
                        <hr>
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center  pb-2 mb-3 border-bottom">
                            <h5 class="titulo-1">Tabela de preços</h5>

                            <div class="btn-toolbar mb-1 ">
                                <div class="btn-group me-2">
                                    <a href="/materia-prima/precos/export/{{$materiaprima->codigo->id}}?data_inicio={{$data_inicio}}&data_fim={{$data_fim}}&empresa_id={{Auth::user()->empresa_id}}&tipo=1" type="button" class="btn btn-sm btn-outline-secondary">
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
                                            <a href="/materia-prima/empresa/{{$materiaprima->id}}?data_inicio={{$data_inicio}}&data_fim={{$data_fim}}&tipo=3" class="d-flex align-items-center  justify-content-between text-black">
                                                Fornecedor
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>Quant. Minima</th>
                                        <th>
                                            <a href="/materia-prima/empresa/{{$materiaprima->id}}?data_inicio={{$data_inicio}}&data_fim={{$data_fim}}&tipo=4" class="d-flex align-items-center  justify-content-between text-black">
                                                Data de Inicio
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="/materia-prima/empresa/{{$materiaprima->id}}?data_inicio={{$data_inicio}}&data_fim={{$data_fim}}&tipo=5" class="d-flex align-items-center  justify-content-between text-black">
                                                Data de Fim
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th>
                                            <a href="/materia-prima/empresa/{{$materiaprima->id}}?data_inicio={{$data_inicio}}&data_fim={{$data_fim}}&tipo=6" class="d-flex align-items-center  justify-content-between text-black">
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
                        @if ($precos->links()->paginator->hasPages())
                        <ul class="pagination p-1">
                            {{ $precos->onEachSide(3)->links() }}
                        </ul>
                        @endif
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

    const data = JSON.parse('{!! $precos_grafico!!}');
    data.reverse();

    var fornecedores = [];
    const labels = [];

    var indexforn = 0;

    for (let index = 0; index < data.length; index++) {

        var dateTime = new Date(data[index].created_at);

        var dia = dateTime.getDate();
        var mes = dateTime.getMonth() + 1;
        var ano = dateTime.getFullYear();

        var dataFormatada = dia + "/" + mes + "/" + ano;

        if (!dataExists(dataFormatada)) {
            labels.push(dataFormatada);
        }

    }


    for (let index = 0; index < data.length; index++) {

        if (labelExists(data[index].fornecedor.nome)) {

            fornecedores.push({
                'label': data[index].fornecedor.nome,
                'data': [data[index].preco]
            });
        }
    }


    for (let index = 0; index < labels.length; index++) {

        for (let a = 0; a < fornecedores.length; a++) {
            if (index == 0) {
                fornecedores[a].data[index] = 0;
            } else {
                fornecedores[a].data[index] = fornecedores[a].data[index - 1];
            }
        }

        for (let j = 0; j < data.length; j++) {
            var dateTime = new Date(data[j].created_at);

            var dia = dateTime.getDate();
            var mes = dateTime.getMonth() + 1;
            var ano = dateTime.getFullYear();

            var dataFormatada = dia + "/" + mes + "/" + ano;

            if (labels[index] === dataFormatada) {
                for (let i = 0; i < fornecedores.length; i++) {
                    if (fornecedores[i].label === data[j].fornecedor.nome) {
                        fornecedores[i].data[index] = data[j].preco;
                    }
                }

            }

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