@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Country
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($country->toArray(), ['route' => ['countries.update', $country->id->getData()], 'method' => 'patch']) !!}

                        @include('countries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection