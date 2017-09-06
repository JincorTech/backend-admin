@extends('layouts.app')

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
    <script>
        $(document).ready(function () {
            var ctx = document.getElementById("myChart").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Company types',
                        data: {!! json_encode($data) !!},
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                display: true,
                                color: "rgba(255,99,132,0.2)"
                            },
                            barPercentage: 1.0,
                            categoryPercentage: 0.8
                        }],
                        xAxes: [{
                            gridLines: {
                                display: false
                            },
                            ticks: {
                                beginAtZero: true,
                                userCallback: function(label, index, labels) {
                                // when the floored value is the same as the value we have a whole number
                                if (Math.floor(label) === label) {
                                    return label;
                                }
                              }
                            }
                        }]
                    }
                }
            });
        });
    </script>
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
                        <h3>{!! $counter !!}</h3>

                        <p>Total Companies Count</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div style="width:100%;height:25vw;margin: auto">
                <canvas id="myChart"></canvas>
            </div>
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
