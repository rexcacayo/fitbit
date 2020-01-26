<div class="table-responsive">
    <table class="table" id="iotServices-table">
        <thead>
            <tr>
            <th>Fiware servidor</th>
                <th>Base de datos</th>
        <th>Apikey</th>
        <th>ORION</th>
        <th>Conjunto de datos</th>
        <th>End Point</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($iotServices as $iotService)
            <tr>
            <td>{!! $iotService->ipServer !!}</td>
                <td>{!! $iotService->fiwareService !!}</td>
            <td>{!! $iotService->apikey !!}</td>
            <td>{!! $iotService->cbroker !!}</td>
            <td>{!! $iotService->entity_type !!}</td>
            <td>{!! $iotService->resource !!}</td>
                <td class="actions">
                    {!! Form::open(['route' => ['iotServices.destroy', $iotService->id], 'method' => 'delete']) !!}

                    <div class=''>
                        <a href="{!! route('iotServices.show', [$iotService->id]) !!}" class='iconoFuente'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <!--<a href="{!! route('iotServices.edit', [$iotService->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>-->
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'iconoFuente', 'onclick' => "return confirm('Seguro que deseas borrar el grupo de IOT?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
