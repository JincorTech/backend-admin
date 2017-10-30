@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Company Type
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($companyType, ['route' => ['companyTypes.update', $companyType->_id->getData()], 'method' => 'patch']) !!}

                        @include('company_types.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection