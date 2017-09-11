@extends('layouts.app')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script src="/js/activities.js"></script>
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
                        <h3>{!! $companyCount !!}</h3>

                        <p>Total Companies Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{!! $employeeCount !!}</h3>

                        <p>Total Employees Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{!! $employeeRegistrations !!}</h3>

                        <p>New employees in last 24 hours</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                </div>
            </div>
            @include('layouts.chartjs', [
                'id' => 'companyTypesStat',
                'title' => 'Company types',
                'labels' => $companyTypeCountStat['labels'],
                'data' => $companyTypeCountStat['data'],
            ])
            @include('layouts.chartjs', [
                'id' => 'countriesStat',
                'title' => 'Countries',
                'labels' => $countryCountStat['labels'],
                'data' => $countryCountStat['data'],
            ])
            @include('layouts.chartjs', [
                'id' => 'employeeCountStat',
                'title' => 'Employee Count',
                'labels' => $employeeCountStat['labels'],
                'data' => $employeeCountStat['data'],
            ])
            <div style="display:block;">
            {!!
            $repo->childrenHierarchy(
                null, /* starting from root nodes */
                false, /* false: load all children, true: only direct */
                [
                    'decorate' => true,
                    'html' => true,
                    'rootOpen' => '<ul>',
                    'rootClose' => '</ul>',
                    'childOpen' => '',
                    'childClose' => '',
                    'nodeDecorator' => function($node) use ($economicalCounts) {

                        $result = '';
                        $en = $node['names']['values']['en'];
                        $ru = $node['names']['values']['ru'];
                        $code = $node['internalCode'];
                        $nodeId = $node['_id']->bin;

                        $title = "<a class=\"tree_node text-primary\" id=\"$nodeId\" href=#>$code: $en / $ru</a>";
                        if (empty($node['__children'])) {
                            $title = "<span class=\"text-muted\">$code: $en / $ru</span>";
                        }

                        $title .= ' ' . $economicalCounts[$nodeId];

                        if ($node['level'] > 1) {
                            $parentId = $node['parent']['$id']->bin;
                            $result .= "<li class=\"hide child$parentId\" id=\"$nodeId\">$title</li>";
                        } else {
                            $result .= "<li>$title</li>";
                        }

                        return $result;
                    }
                ]
            ) !!}
            </div>
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
