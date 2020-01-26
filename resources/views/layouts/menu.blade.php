<!--<li class="{{ Request::is('entities*') ? 'active' : '' }}">
    <a href="{!! route('entities.index') !!}"><i class="fa fa-edit"></i><span>Entities</span></a>
</li>

<li class="{{ Request::is('atributes*') ? 'active' : '' }}">
    <a href="{!! route('atributes.index') !!}"><i class="fa fa-edit"></i><span>Atributes</span></a>
</li>-->


<li class="{{ Request::is('iotServices*') ? 'active' : '' }}">
    <a href="{!! route('iotServices.index') !!}"><i class="fas fa-cloud" style="padding-right: 8px;"></i><span>Servicios</span></a>
</li>

<li class="{{ Request::is('iotDevices*') ? 'active' : '' }}">
    <a href="{!! route('iotDevices.index') !!}"><i class="fas fa-microchip" style="padding-right: 8px;"></i><span>Sensores</span></a>
</li>

<li class="{{ Request::is('notifies*') ? 'active' : '' }}">
    <a href="{!! route('notifies.index') !!}"><i class="fas fa-bell" style="padding-right: 8px;"></i><span>Notificación</span></a>
</li>

<!--<li class="{{ Request::is('temperatura*') ? 'active' : '' }}">
    <a href="{!! route('temperatura.form') !!}"><i class="fas fa-thermometer-half" style="padding-right: 8px;"></i><span>Gráfico Tempreratura</span></a>
</li>

<li class="{{ Request::is('presion*') ? 'active' : '' }}">
    <a href="{!! route('presion.formPresion') !!}"><i class="fas fa-chart-area" style="padding-right: 8px;"></i><span>Gráfico Presión</span></a>
</li>

<li class="{{ Request::is('humedad*') ? 'active' : '' }}">
    <a href="{!! route('humedad.formHumedad') !!}"><i class="fas fa-tint" style="padding-right: 8px;"></i><span>Gráfico Humedad</span></a>
</li>-->

<li class="{{ Request::is('fitbits*') ? 'active' : '' }}">
    <a href="{!! route('fitbits.index') !!}"><i class="fa fa-edit"></i><span>Fitbits</span></a>
</li>

<li class="{{ Request::is('heartRates*') ? 'active' : '' }}">
    <a href="{!! route('heartRates.create') !!}"><i class="fa fa-edit"></i><span>Zonas Cardíacas</span></a>
</li>

<li class="{{ Request::is('heartInterDays*') ? 'active' : '' }}">
    <a href="{!! route('heartInterDays.create') !!}"><i class="fa fa-edit"></i><span>Ritmo Cardíaco</span></a>
</li>

<li class="{{ Request::is('sleeps*') ? 'active' : '' }}">
    <a href="{!! route('sleeps.index') !!}"><i class="fa fa-edit"></i><span>Sleeps</span></a>
</li>

