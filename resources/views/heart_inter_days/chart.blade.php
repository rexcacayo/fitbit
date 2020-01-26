@extends('layouts.app')
@php
$total = count($datos);
@endphp

@section('content')
    <section class="content-header flexInputChart">
            <div class="headerInput vCenter">
                    <h1>Lectura de ritmo cardíaco</h1>

                    <p class="txtHeaderFecha">Fecha: {{$rango}}</p>
                </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">


            <div class="box-body">
                <div class="row formInputChart">
                    <html>
    <style>
        .headerInput {
            background-color: #3d4f7c;
            height: 8vh;
            color: white;
            font-size: 9px !important;
            padding-left: 10px;
        }
        .txtHeaderFecha{
            font-size:14px;
        }
    </style>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {
        var ventana_ancho = $(window).width() - 550;
        var ventana_alto = $(window).height() - 400;
        if(ventana_ancho > 834 && ventana_ancho < 1599){
            ventana_ancho = 800;
        }



        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Calorías');
        data.addColumn('number', 'Tiempo');
        data.addRows([
            @for($i=0; $i<$total; $i++)
                ['{{ $datos[$i]['x'] }}' , {{ $datos[$i]['y'] }}],
            @endfor
        ]);
        // Set chart option
        var options = {
                       'width':ventana_ancho,
                       'height':ventana_alto,
                       chartArea: {height: '95%'}

                    };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>


        <div id="chart_div"></div>

  </body>
</html>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
        $(document).ready(function($){
        $(window).resize(function(){
            var ventana_ancho = $(window).width();
            var ventana_alto = $(window).height();
            drawChart();
        })
      });
    </script>
