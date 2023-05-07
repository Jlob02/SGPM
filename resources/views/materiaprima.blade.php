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
                Materia-prima > @isset($materiaprima) {{$materiaprima->designacao}} @endisset
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

                    <div class="col-12">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-2 pb-2 mb-3 border-bottom">
                            <h4>@isset($materiaprima) {{$materiaprima->designacao}} @endisset</h4>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                    <span data-feather="calendar" class="align-text-bottom"></span>
                                    This week
                                </button>
                            </div>
                        </div>
                        <canvas class="" id="myChart" width="900" height="270"></canvas>
                    </div>

                    <div class="col-12 mb-5">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h4>Tabela de preços</h4>

                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group me-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">
                                        Export CSV
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            @isset($precos)
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Pais</th>
                                        <th>Empresa</th>
                                        <th>Fornecedor</th>
                                        <th>preco</th>
                                        <th>Unidade</th>
                                        <th>Data de inicio</th>
                                        <th>Data de fim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($precos as $preco)
                                    <tr>
                                        <td>{{$preco->materiaprima->empresa->pais}}</td>
                                        <td>{{$preco->materiaprima->empresa->nome}}</td>
                                        <td>{{$preco->fornecedor->nome}}</td>
                                        <td>{{$preco->preco}}</td>
                                        <td>@if($preco->unidade == 1)
                                            Kg
                                            @else
                                            T
                                            @endif</td>
                                        <td>{{$preco->data_inicio}}</td>
                                        <td>{{$preco->data_fim}}</td>
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

    const data1 = ['0.1234', '0.33545', '0.365765', '0.435365','0.34245', '0.2675265', '0.435365','0.34245', '0.2675265', '0.365765', '0.435365','0.34245', '0.2675265',];

    new Chart(ctx, {
        type: "line",
        data: {
            labels: month,
            datasets: [{
                label: "AGRUPACION FAB. ACEITES MARINOS SA",
                data: data1,
                borderWidth: 3,
            }, ],
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