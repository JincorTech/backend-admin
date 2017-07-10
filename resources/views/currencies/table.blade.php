<table class="table table-responsive" id="currencies-table">
    <thead>
        <th>English Name</th>
        <th>Russian Name</th>
        <th>Alpha3 Code</th>
        <th>Numeric Code</th>
        <th>Sign</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($currencies as $currency)
        <tr>
            <td>{!! $currency->names['en'] !!}</td>
            <td>{!! $currency->names['ru'] !!}</td>
            <td>{!! $currency->ISOCodes['alpha3Code'] !!}</td>
            <td>{!! $currency->ISOCodes['numericCode'] !!}</td>
            <td>{!! $currency->sign !!}</td>
            <td>
                {!! Form::open(['route' => ['currencies.destroy', $currency->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('currencies.show', [$currency->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('currencies.edit', [$currency->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>