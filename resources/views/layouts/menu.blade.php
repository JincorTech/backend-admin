<li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
    <a href="{!! route('dashboard.index') !!}"><i class="fa fa-edit"></i><span>Dashboard</span></a>
</li>

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

<li class="{{ Request::is('mailingListItems*') ? 'active' : '' }}">
    <a href="{!! route('mailingListItems.index') !!}"><i class="fa fa-edit"></i><span>Mailing List</span></a>
</li>

<li class="{{ Request::is('departments*') ? 'active' : '' }}">
    <a href="{!! route('departments.index') !!}"><i class="fa fa-edit"></i><span>Departments</span></a>
</li>

<li class="{{ Request::is('employees*') ? 'active' : '' }}">
    <a href="{!! route('employees.index') !!}"><i class="fa fa-edit"></i><span>Employees</span></a>
</li>

<li class="{{ Request::is('cities*') ? 'active' : '' }}">
    <a href="{!! route('cities.index') !!}"><i class="fa fa-edit"></i><span>Cities</span></a>
</li>

