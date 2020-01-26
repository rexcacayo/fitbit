@extends('layouts.app')

@section('content')
    <section class="content-header flexInputChart">
            <div class="headerInput vCenter">
                    <h1>Lectura de Temperatura, {{$rango}}</h1>
                </div>

    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row formInputChart">
                    <html>
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
        var ventana_ancho = $(window).width() - 500;
        var ventana_alto = $(window).height() - 400;
        if(ventana_ancho > 834){
            ventana_ancho = 800;
        }


        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tiempo');
        data.addColumn('number', 'Temperatura ºC');
        data.addRows([
            @foreach($datos as $dato)
                    @if ($dato->attrValue === "nan")
                        [' {{ substr($dato->recvTime, 11,-7) }}', {{ "0" }} ],
                    @else
                        [' {{ substr($dato->recvTime, 11,-7) }}', {{ $dato->attrValue }} ],
                @endif
            @endforeach
        ]);

        // Set chart option
        var options = {
                       'width':ventana_ancho,
                       'height':ventana_alto,
                       chartArea: {height: '95%'},
                    };

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->

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
