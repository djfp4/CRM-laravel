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
                                <div id="container-4" class="col-lg-12"></div>
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




// Crear un array para almacenar los datos de los días del mes
var data = [];

// Generar los puntos para cada día del mes
var json = '<?= $data3?>';
console.log(json)
var datas = JSON.parse(json);
var objetivo=[];
var bonus=[];
var cliente1=1;
var cliente2=2;
var cliente3=3;
datas.forEach(function(item) {
  var date = item.y;
  var sale = item.venta;
  var partes = date.split('-');
    var año = parseInt(partes[0]);
    var mes = parseInt(partes[1])-1; // Restamos 1 al mes, ya que en JavaScript los meses van de 0 a 11
    var dia = parseInt(partes[2]);
  console.log(dia);
// if (dia==20) {
//     var point3 = [Date.UTC(año,mes,dia), 0];
//     cliente3 = 0;
// }else{
    var point3 = [Date.UTC(año,mes,dia), 4];
// }
// if (dia==10) {
//     var point2 = [Date.UTC(año,mes,dia), 0];
//     cliente2=0;
// }else{
    var point2 = [Date.UTC(año,mes,dia), 2];
// }
// if (dia==25) {
//     var point = [Date.UTC(año,mes,dia), 0];
//     cliente1 = 0;
// }else{
    var point = [Date.UTC(año,mes,dia), sale];
// }
  
  
  
  data.push(point);
  objetivo.push(point2);
  bonus.push(point3);
});

// Configuración del gráfico
Highcharts.chart('container-4', {
    title: {
        text: 'Historial de clientes'
    },
    xAxis: {
        type: 'datetime',
        accessibility: {
            rangeDescription: 'Range: 1 to 31'
        }
    },
    yAxis: {
        type: 'logarithmic',
        minorTickInterval: 0.5,
        accessibility: {
            rangeDescription: 'Range: 0 to 1000'
        }
    },
    tooltip: {
        headerFormat: '<b>{series.name}</b><br />',
        pointFormat: 'fecha = {point.x:%e %b}, ventas = {point.y}'
    },
    series: [{
        name: "Cliente 1",
        data:  data,
        // Utilizar los datos generados dinámicamente
        
    },
    {
        name: "Cliente 2",
        data: objetivo,
        // Utilizar los datos generados dinámicamente
        
    },
    {
        name: "Cliente 3",
        data: bonus,
        // Utilizar los datos generados dinámicamente
        
    },
    ]

  
});


</script>
@endsection

