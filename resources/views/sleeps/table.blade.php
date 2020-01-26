<div class="table-responsive">
    <table class="table" id="sleeps-table">
        <thead>
            <tr>
                
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sleeps as $sleep)
            <tr>
                
                <td>
                    {!! Form::open(['route' => ['sleeps.destroy', $sleep->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('sleeps.show', [$sleep->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('sleeps.edit', [$sleep->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
