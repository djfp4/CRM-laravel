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
        text: 'Agentes con mas ventas'
    },
    subtitle: {
        align: 'left',
        text: 'En esta grafica se puede observar a los tres agentes con más ventas'
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
            text: 'Ventas en el ultimo mes'
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
                format: '{y} Ventas'
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
        text: 'Clientes con más seguimiento'
    },
    subtitle: {
        align: 'left',
        text: 'En esta grafica se puede observar a los clientes que han recibido mayor seguimiento'
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
            data: <?= $data2?>
        }
    ],
    
});





</script>
@endsection

