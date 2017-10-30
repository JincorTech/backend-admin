@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Currency
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($currency, ['route' => ['currencies.update', $currency->id->getData()], 'method' => 'patch']) !!}

                        @include('currencies.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection