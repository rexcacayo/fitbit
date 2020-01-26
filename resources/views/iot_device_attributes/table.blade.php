<div class="table-responsive">
    <table class="table" id="iotDeviceAttributes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Type</th>
        <th>Entity Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($iotDeviceAttributes as $iotDeviceAttribute)
            <tr>
                <td>{!! $iotDeviceAttribute->name !!}</td>
            <td>{!! $iotDeviceAttribute->type !!}</td>
            <td>{!! $iotDeviceAttribute->entity_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['iotDeviceAttributes.destroy', $iotDeviceAttribute->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('iotDeviceAttributes.show', [$iotDeviceAttribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('iotDeviceAttributes.edit', [$iotDeviceAttribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
