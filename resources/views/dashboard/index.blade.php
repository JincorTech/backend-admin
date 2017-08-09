@extends('layouts.app')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="/js/dashboard.js"></script>
@endpush

@section('content')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#companies">Companies</a></li>
        <li><a data-toggle="tab" href="#employees">Employees</a></li>
        <li><a data-toggle="tab" href="#search">Search</a></li>
    </ul>

    <div class="tab-content">
        <div id="companies" class="tab-pane fade in active">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>20</h3>

                        <p>Total Companies Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div id="employees" class="tab-pane fade">
            <h3>Employees</h3>
            <p>Some content in menu 1.</p>
        </div>
        <div id="search" class="tab-pane fade">
            <h3>Search</h3>
            <p>Some content in menu 2.</p>
        </div>
    </div>
@endsection
