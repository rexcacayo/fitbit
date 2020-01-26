<div class="table-responsive">
    <table class="table" id="atributes-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Type</th>
        <th>Value</th>
        <th>Entity Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($atributes as $atribute)
            <tr>
                <td>{!! $atribute->name !!}</td>
            <td>{!! $atribute->type !!}</td>
            <td>{!! $atribute->value !!}</td>
            <td>{!! $atribute->entity_id !!}</td>
                <td>
                    {!! Form::open(['route' => ['atributes.destroy', $atribute->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('atributes.show', [$atribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('atributes.edit', [$atribute->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
