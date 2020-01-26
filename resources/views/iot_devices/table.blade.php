<div class="table-responsive">
    <table class="table" id="iotDevices-table">
        <thead>
            <tr>
                <th>Servidor Fiware</th>
        <th>Base de datos</th>
        <th>Device Id</th>
        <th>Nombre del sensor</th>
        <th>Conjunto de datos</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($iotDevices as $iotDevice)
            <tr>
                <td>{!! $iotDevice->ipServer !!}</td>
            <td>{!! $iotDevice->fiwareService !!}</td>
            <td>{!! $iotDevice->device_id !!}</td>
            <td>{!! $iotDevice->entity_name !!}</td>
            <td>{!! $iotDevice->entity_type !!}</td>
                <td class="actions">
                    {!! Form::open(['route' => ['iotDevices.destroy', $iotDevice->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('iotDevices.show', [$iotDevice->id]) !!}" class='iconoFuente'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <!--<a href="{!! route('iotDevices.edit', [$iotDevice->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>-->
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'iconoFuente', 'onclick' => "return confirm('Seguro que desea borrar el sensor?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
