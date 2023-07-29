@extends('layouts.app')

@section('content')
<section class="section">
        <div class="section-header">
            <h3 class="page__heading">Reportes</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <hr>
                        <h2>Ventas totales: {{$grafica3->venta}} $us</h2>
                        <hr>
                            <div class="row">
                                <form method="GET" action="{{ route('reporte.index') }}">
                                <div class="row">
                                <div class="col-xs-9 col-sm-9 col-md-9">
                                    <input type="date" name="fecha1" class="form-control" required>
                                    <input type="date" name="fecha2" class="form-control" required>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <input type="submit" value="Filtrar" class="btn btn-primary">
                                </div></div>
                                </form>
                            </div>
                            <div class="row">
                                <div id="container" class="col-lg-6"></div>
                                <div id="container-2" class="col-lg-6"></div>
                            </div>
                            
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Clientes con numero de seguimiento'
    },
    subtitle: {
        align: 'left',
        text: 'En esta grafica se puede observar a los clientes con el numero de seguimientos que se realizo a cada uno'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        categories: <?= $dataNom?>
    },
    yAxis: {
        title: {
            text: 'Seguimiento historico'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{y} Actividades'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: "Control",
            colorByPoint: true,
            data: <?= $data?>
        }
    ],
    
});

Highcharts.chart('container-2', {
    chart: {
        type: 'column'
    },
    title: {
        align: 'left',
        text: 'Ventas de agentes'
    },
    subtitle: {
        align: 'left',
        text: 'En esta grafica se puede observar el valor de las ventas por agente'
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        categories: <?= $dataNom2?>
    },
    yAxis: {
        title: {
            text: 'Actividades realizadas'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{y} $us'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
    },

    series: [
        {
            name: "Control",
            colorByPoint: true,
            data: <?= $data2?>
        }
    ],
    
});




</script>
@endsection

