<div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
    <div class="p-5">
        {{-- content --}}
        <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between mb-5">
              <div class="">
                <h3 class="text-2xl font-semibold text-gray-500 dark:text-gray-200">Transaksi Minggu ini</h3>
              </div>
            </div>
        </div>
        <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6" id="line-chart"></div>
        <script>
            const chartData = @json($chart);
            const options = {
              chart: {
                height: "100%",
                maxWidth: "100%",
                type: "line",
                fontFamily: "Inter, sans-serif",
                dropShadow: {
                  enabled: false,
                },
                toolbar: {
                  show: false,
                },
              },
              tooltip: {
                enabled: true,
                x: {
                  show: true,
                },
              },
              dataLabels: {
                enabled: false,
              },
              stroke: {
                width: 6,
              },
              grid: {
                show: true,
                strokeDashArray: 4,
                padding: {
                  left: 10,
                  bottom: 10,
                  right: 2,
                  top: -26
                },
              },
              
              series: chartData,
              legend: {
                show: false
              },
              stroke: {
                curve: 'smooth'
              },
              xaxis: {
                type: 'datetime', // Dynamically handle dates
                labels: {
                  show: true,
                  style: {
                    fontFamily: "Inter, sans-serif",
                    cssClass: 'text-xs font-normal fill-gray-500 dark:fill-gray-400'
                  }
                },
                axisBorder: {
                  show: false,
                },
                axisTicks: {
                  show: false,
                },
              },
              yaxis: {
                show: true,
              },
            }
      
            if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
              const chart = new ApexCharts(document.getElementById("line-chart"), options);
              chart.render();
            }
        </script>
    </div>
</div>
