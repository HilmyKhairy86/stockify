<div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
    <div class="p-5">
        {{-- content --}}
        <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
            <div class="flex justify-between mb-5">
              <div class="grid gap-4 grid-cols-9">
                {{-- item 1 --}}
                {{-- foreach --}}
                {{-- @foreach ($prod as $p)  
                <div>
                  <h5 class="inline-flex items-center text-gray-500 dark:text-gray-400 leading-none font-normal mb-2">{{$p->product->name}}</h5>
                  <p class="text-gray-900 dark:text-white text-2xl leading-none font-bold">{{$p->product->stock}}</p>
                </div>
                @endforeach --}}
              </div>

              {{-- select --}}
                  <div>
                    <select wire:model.live="filterstock" class="text-md dark:bg-gray-800 py-2.5 px-0 text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                      <option value="day">Sehari</option>
                      <option value="week" selected=''>Seminggu</option>
                      <option value="month">Sebulan</option>
                      <option value="year">Setahun</option>
                    </select>
                  <div id="lastDaysdropdown" class="z-10 px-3 py-2 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                </div>
              </div>
            </div>
            {{-- chart --}}
            {{-- <div id="line-chart"></div> --}}
            <div id="line-chart"></div>

            {{-- footer --}}
            {{-- <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
              <div class="pt-5">      
                <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z"/>
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                  </svg>
                  View full report
                </a>
              </div>
            </div> --}}
          </div>
        
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
