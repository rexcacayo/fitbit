<div class="table-responsive">
    <table class="table" id="entities-table">
        <thead>
            <tr>
                <th>Ip Server</th>
        <th>Fiware Service</th>
        <th>Fiware Path</th>
        <th>Entity Id</th>
        <th>Type Entity</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($entities as $entity)
            <tr>
                <td>{!! $entity->ipServer !!}</td>
            <td>{!! $entity->fiwareService !!}</td>
            <td>{!! $entity->fiwarePath !!}</td>
            <td>{!! $entity->entityID !!}</td>
            <td>{!! $entity->typeEntity !!}</td>
                <td>
                    {!! Form::open(['route' => ['entities.destroy', $entity->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('entities.show', [$entity->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
