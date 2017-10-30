<table class="table table-responsive" id="countries-table">
    <thead>
        <th>English Name</th>
        <th>Russian Name</th>
        <th>Phone Code</th>
        <th>ISO2 Code</th>
        <th>Numeric Code</th>
        <th>Alpha2 Code</th>
        <th>Alpha3 Code</th>
        <th>Currency</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($countries as $country)
        <tr>
            <td>{!! $country->names['en'] !!}</td>
            <td>{!! $country->names['ru'] !!}</td>
            <td>{!! $country->phoneCode !!}</td>
            <td>{!! $country->ISOCodes['ISO2Code'] !!}</td>
            <td>{!! $country->ISOCodes['numericCode'] !!}</td>
            <td>{!! $country->ISOCodes['alpha2Code'] !!}</td>
            <td>{!! $country->ISOCodes['alpha3Code'] !!}</td>
            <td>{!! $country->getCurrency()->ISOCodes['alpha3Code'] !!}</td>
            <td>
                {!! Form::open(['route' => ['countries.destroy', $country->id->getData()], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('countries.show', [$country->id->getData()]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('countries.edit', [$country->id->getData()]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>