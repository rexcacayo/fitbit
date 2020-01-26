<div class="table-responsive">
    <table class="table" id="notifies-table">
        <thead>
            <tr>
                <th>Servidor Fiware</th>
        <th>Base de datos</th>
        <th>Nombre del puerto</th>
        <th>Conjunto de datos</th>
        <th>Descripción</th>
                <th colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notifies as $notify)
            <tr>
                <td>{!! $notify->ipServer !!}</td>
            <td>{!! $notify->fiwareService !!}</td>
            <td>{!! $notify->fiwarePath !!}</td>
            <td>{!! $notify->type !!}</td>
            <td>{!! $notify->description !!}</td>
                <td class="actions">
                    {!! Form::open(['route' => ['notifies.destroy', $notify->id], 'method' => 'delete']) !!}
                    <div class=''>
                            <a href="{!! route('notifies.show', [$notify->id]) !!}" class='iconoFuente'><i class="glyphicon glyphicon-eye-open"></i></a>

                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'iconoFuente', 'onclick' => "return confirm('Seguro que desea borrar la subscripción?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
