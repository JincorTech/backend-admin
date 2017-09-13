@push('scripts')
    <script>
      $(document).ready(function () {
        var chart = document.getElementById("{!! $id !!}").getContext('2d');
        var labels = {!! json_encode($labels) !!};
        new Chart(chart, {
          type: 'horizontalBar',
          data: {
            labels: labels,
            datasets: [{
              label: {!! json_encode($title) !!},
              data: {!! json_encode($data) !!},
              backgroundColor: labels.map(function () {
                var letters = '0123456789ABCDEF';
                var color = '#';
                for (var i = 0; i < 6; i++) {
                  color += letters[Math.floor(Math.random() * 16)];
                }
                return color;
              }),
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
                  userCallback: function (label, index, labels) {
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
      })
    </script>
@endpush
<div class="clearfix"></div>
<div style="width:100%;height:25vw;margin: auto">
    <canvas id="{!! $id !!}"></canvas>
</div>