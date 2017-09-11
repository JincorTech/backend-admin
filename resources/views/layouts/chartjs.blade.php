@push('scripts')
    <script>
      $(document).ready(function () {
        var chart = document.getElementById("{!! $id !!}").getContext('2d');
        new Chart(chart, {
          type: 'horizontalBar',
          data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
              label: {!! json_encode($title) !!},
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