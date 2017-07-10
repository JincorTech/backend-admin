<table class="table table-responsive" id="companyTypes-table">
    <thead>
        <th>Code</th>
        <th>English Name</th>
        <th>Russian Name</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($companyTypes as $companyType)
        <tr>
            <td>{!! $companyType->code !!}</td>
            <td>{!! $companyType->names['values']['en'] !!}</td>
            <td>{!! $companyType->names['values']['ru'] !!}</td>
            <td>
                {!! Form::open(['route' => ['companyTypes.destroy', $companyType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('companyTypes.show', [$companyType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('companyTypes.edit', [$companyType->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>