@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
@php
$RRHH_Dataset = array('values' => array(0, 0, 0), 'labels' => array('Correctos', 'A vencerse', 'Pendientes'), 'colors' => array('rgba(82, 190, 128, 0.5)', 'rgba(243, 156, 18, 0.5)', 'rgba(169, 50, 38, 0.5)'), 'borders' => array('rgba(82, 190, 128)', 'rgba(243, 156, 18)', 'rgba(169, 50, 38)'), 'url' => array('#', '#', '#'));
$Vehiculos_Dataset = array('values' => array(0, 0, 0), 'labels' => array('Correctos', 'A vencerse', 'Pendientes'), 'colors' => array('rgba(88, 214, 141, 0.5)', 'rgba(248, 196, 113 , 0.5)', 'rgba(236, 112, 99, 0.5)'), 'borders' => array('rgba(88, 214, 141, 1)', 'rgba(248, 196, 113 , 1)', 'rgba(236, 112, 99, 1)'), 'url' => array('#', '#', '#'));

foreach ($data as $item) {
    if($item->label == 'RRHH - CORRECTO')
        {
            $RRHH_Dataset['values'][0] = $item->q;
            $RRHH_Dataset['url'][0] = $item->label;
        }
    elseif($item->label == 'RRHH - A VENCERSE') {
            $RRHH_Dataset['values'][1] = $item->q;
            $RRHH_Dataset['url'][1] = $item->label;
    }
    elseif($item->label == 'RRHH - PENDIENTE') {    
            $RRHH_Dataset['values'][2] = $item->q;
            $RRHH_Dataset['url'][2] = $item->label;
    }
    elseif($item->label == 'VEHICULO - CORRECTO')
        {
            $Vehiculos_Dataset['values'][0] = $item->q;
            $Vehiculos_Dataset['url'][0] = $item->label;
        }
    elseif($item->label == 'VEHICULO - A VENCERSE') {
            $Vehiculos_Dataset['values'][1] = $item->q;
            $Vehiculos_Dataset['url'][1] = $item->label;
    }
    elseif($item->label == 'VEHICULO - PENDIENTE') {    
            $Vehiculos_Dataset['values'][2] = $item->q;
            $Vehiculos_Dataset['url'][2] = $item->label;
    }
}
@endphp

<main class="py-4">
        
    <div class="container">
    <div class="container" style="width:90%;">
        <div class="row"> 
         <div class="col-sm-2 align-middle"> 
        <div class="card border-secondary mx-sm-1 p-3">
            <div class="card border-secondary shadow text-secondary p-3 my-card">
                <span class="fa fa-user" aria-hidden="true"></span>
            </div>
            <div class="text-center mt-3 p-1">
                <button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$RRHH_Dataset['url'][0]."')" @endphp" class="btn btn-success btn"><i class="fa fa-check-circle" aria-hidden="true"></i> @php echo $RRHH_Dataset['values'][0]; @endphp</button></div>
                <div class="text-center mt-3 p-1"><button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$RRHH_Dataset['url'][1]."')" @endphp" class="btn btn-warning btn"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> @php echo $RRHH_Dataset['values'][1]; @endphp</button></div>
                <div class="text-center mt-3 p-1"><button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$RRHH_Dataset['url'][2]."')" @endphp" class="btn btn-danger btn"><i class="fa fa-minus-circle" aria-hidden="true"></i> @php echo $RRHH_Dataset['values'][2]; @endphp</button></div>
          </div>
        </div>
       <div class="col-sm-8">
            <canvas id="ComparativeChart"></canvas>
        </div>
       <div class="col-sm-2 align-middle"> 
        <div class="card border-secondary mx-sm-1 p-3">
            <div class="card border-secondary shadow text-secondary p-3 my-card">
                <span class="fa fa-truck" aria-hidden="true"></span>
            </div>
            <div class="text-center mt-3 p-1">
                <button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$Vehiculos_Dataset['url'][0]."')" @endphp" class="btn btn-success btn"><i class="fa fa-check-circle" aria-hidden="true"></i> @php echo $Vehiculos_Dataset['values'][0]; @endphp</button></div>
                <div class="text-center mt-3 p-1"><button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$Vehiculos_Dataset['url'][1]."')" @endphp" class="btn btn-warning btn"><i class="fa fa-exclamation-circle" aria-hidden="true"></i> @php echo $Vehiculos_Dataset['values'][1]; @endphp</button></div>
                <div class="text-center mt-3 p-1"><button type="button" data-bs-toggle='modal' data-bs-target='#SampleModal' onclick="@php echo "fill('".$Vehiculos_Dataset['url'][2]."')" @endphp" class="btn btn-danger btn"><i class="fa fa-minus-circle" aria-hidden="true"></i> @php echo $Vehiculos_Dataset['values'][2]; @endphp</button></div>
          </div>
        </div>
        <div class="row"> 
         <div class="col"><canvas id="BarChart"></canvas></div>
         <div class="col"><canvas id="PieChart"></canvas></div>
        </div>
    </div>
    <hr>
    <div class="row">
    </div>


<script>
$( document ).ready(function() {

@php

echo "var ComparativeChart = new Chart($('#ComparativeChart'), 
{
    type: 'bar',
    data: {
        labels: ['".implode("','", $RRHH_Dataset['labels'])."'],
     datasets: [
                {
                label: 'Recursos Humanos',
                data: [".implode(', ', $RRHH_Dataset['values'])."],
                borderColor:  ['".implode("','", $RRHH_Dataset['borders'])."'],
                backgroundColor: ['".implode("','", $RRHH_Dataset['colors'])."'],
                borderWidth: 1,
                borderSkipped: false,
                },
                {
                label: 'Vehículos / Maquinaria',
                data: [".implode(', ', $Vehiculos_Dataset['values'])."],
                borderColor:  ['".implode("','", $Vehiculos_Dataset['borders'])."'],
                backgroundColor: ['".implode("','", $Vehiculos_Dataset['colors'])."'],
                borderWidth: 1,
                borderSkipped: false,
                }
            
        ]
            },
    options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        display: false
                    },
                title: {
                    display: true,
                    text: 'CANTIDAD DE SUCESOS TOTALES'
                }
                },
                scales: {
                    x: {
                    stacked: true,
                    },
                    y: {
                    stacked: true
                    }
                }
            }
});

var BarChart = new Chart($('#BarChart'), {
    type: 'bar',
    data: {
        labels: ['".implode("','", $RRHH_Dataset['labels'])."'],
     datasets: [
    {
      label: 'Recursos Humanos',
      data: [".implode(', ', $RRHH_Dataset['values'])."],
      borderColor:  ['".implode("','", $RRHH_Dataset['borders'])."'],
      backgroundColor: ['".implode("','", $RRHH_Dataset['colors'])."'],
      borderWidth: 1,
      borderRadius: 10,
      borderSkipped: false,
    },
    {
      label: 'Vehículos / Maquinaria',
      data: [".implode(', ', $Vehiculos_Dataset['values'])."],
      borderColor:  ['".implode("','", $Vehiculos_Dataset['borders'])."'],
      backgroundColor: ['".implode("','", $Vehiculos_Dataset['colors'])."'],
      borderWidth: 1,
      borderRadius: 25,
      borderSkipped: false,
    }
            
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
            display: false
           },
          title: {
            display: true,
            text: 'CANTIDAD DE SUCESOS POR RECURSOS HUMANOS / VEHÍCULOS'
          }
        }
      }
});

var PieChart = new Chart($('#PieChart'), {
    type: 'doughnut',
    data: {
        labels: ['".implode("','", $RRHH_Dataset['labels'])."'],
     datasets: [
    {
      label: 'Recursos Humanos',
      data: [".implode(', ', $RRHH_Dataset['values'])."],
      borderColor:  ['rgba(255, 255, 255)'],
      backgroundColor: ['".implode("','", $RRHH_Dataset['colors'])."']
    },
    {
      label: 'Vehículos / Maquinaria',
      data: [".implode(', ', $Vehiculos_Dataset['values'])."],
      borderColor:  ['rgba(255, 255, 255)'],
      backgroundColor: ['".implode("','", $Vehiculos_Dataset['colors'])."'],
    }           
            ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: 'top',
          },
          title: {
            display: true,
            text: 'TOTALES POR RRHH / VEHÍCULO'
          }
        }
      }
})";

@endphp

});
function fill(label) { 
    $('#SampleModalLabel').text(label);
    $.ajax({
    url: '/homeshow/' + label ,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      var rows = '';
      if(data.length > 0) {
          $.each(data, function(i, item){
             rows+= '<tr><td>' + item.field1 + '</td><td>' + item.field2 + '</td><td>' + item.field3 + '</td></tr>'; 
            });
  }
  $('#SampleContent').html(rows); 
 
}
   
}); 
}
</script>
            
        </div>
    </div>
</div>
@endsection
