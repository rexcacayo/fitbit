<div class="table-responsive">
    <table class="table" id="fitbits-table">
        <thead>
            <tr>
                
        <th>User Id</th>
        <th>Name</th>
        
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($fitbits as $fitbit)
            <tr>
                
            <td>{!! $fitbit->user_id !!}</td>
            <td>{!! $fitbit->name !!}</td>
            
                <td>
                    {!! Form::open(['route' => ['fitbits.destroy', $fitbit->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{!! route('fitbits.show', [$fitbit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{!! route('fitbits.edit', [$fitbit->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
