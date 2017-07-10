<li class="{{ Request::is('companies*') ? 'active' : '' }}">
    <a href="{!! route('companies.index') !!}"><i class="fa fa-edit"></i><span>Companies</span></a>
</li>

<li class="{{ Request::is('companyTypes*') ? 'active' : '' }}">
    <a href="{!! route('companyTypes.index') !!}"><i class="fa fa-edit"></i><span>Company Types</span></a>
</li>



<li class="{{ Request::is('currencies*') ? 'active' : '' }}">
    <a href="{!! route('currencies.index') !!}"><i class="fa fa-edit"></i><span>Currencies</span></a>
</li>

<li class="{{ Request::is('economicalActivityTypes*') ? 'active' : '' }}">
    <a href="{!! route('economicalActivityTypes.index') !!}"><i class="fa fa-edit"></i><span>Economical Activity Types</span></a>
</li>

<li class="{{ Request::is('countries*') ? 'active' : '' }}">
    <a href="{!! route('countries.index') !!}"><i class="fa fa-edit"></i><span>Countries</span></a>
</li>

