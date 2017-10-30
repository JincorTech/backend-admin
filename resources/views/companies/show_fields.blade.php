<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $company->id->getData() !!}</p>
</div>

<!-- Legalname Field -->
<div class="form-group">
    {!! Form::label('legalName', 'Legal Name:') !!}
    <p>{!! $company->profile['legalName'] !!}</p>
</div>

<!-- Company Type Field -->
<div class="form-group">
    {!! Form::label('companyType', 'Company Type:') !!}
    <p>{!! $company->companyType['names']['values']['en'] . ' / ' . $company->companyType['names']['values']['ru'] !!}</p>
</div>
