<table class="table table-responsive" id="companies-table">
    <thead>
        <th>Legal Name</th>
        <th>Company Type</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($companies as $company)
        <tr>
            <td>{!! $company->profile['legalName'] !!}</td>
            <td>{!! $company->companyType['names']['values']['en'] !!}</td>
            <td>
                {!! Form::open(['route' => [
                        $company->isBlocked() ? 'companies.unblock' : 'companies.block',
                        $company->id
                    ], 'method' => 'post']) !!}
                <div class='btn-group'>
                    <a href="{!! route('companies.show', [$company->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    {!! $company->isBlocked() ?
                        Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-success btn-xs', 'onclick' => "return confirm('Are you sure you want to unblock this company?')"])
                        :
                        Form::button('<i class="glyphicon glyphicon-ban-circle"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure you want to block this company?')"])
                    !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
