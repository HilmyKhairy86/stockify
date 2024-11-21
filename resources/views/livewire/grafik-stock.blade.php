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
                <button id="dropdownDefaultButton"
                  data-dropdown-toggle="lastDaysdropdown"
                  data-dropdown-placement="bottom" type="button" class="px-3 py-2 inline-flex items-center text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Last week <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
              </svg></button>
              <div id="lastDaysdropdown" class="z-10 px-3 py-2 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                      <li>
                        <input wire:model.live="day" id="" type="radio" name="day" value="day" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="" class="px-4 py-2 dark:hover:text-white">Today</label>
                      </li>
                      <li>
                        <input wire:model.live="day" id="" type="radio" name="day" value="week" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="" class="px-4 py-2 dark:hover:text-white">Week</label>
                      </li>
                      <li>
                        <input wire:model.live="day" id="" type="radio" name="day" value="month" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        <label for="" class="px-4 py-2 dark:hover:text-white">Month</label>
                      </li>
                    </ul>
                </div>
              </div>
            </div>
            {{-- chart --}}
            <div id="line-chart"></div>

            {{-- footer --}}
            <div class="grid grid-cols-1 items-center border-gray-200 border-t dark:border-gray-700 justify-between mt-2.5">
              <div class="pt-5">      
                <a href="#" class="px-5 py-2.5 text-sm font-medium text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <svg class="w-3.5 h-3.5 text-white me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                    <path d="M14.066 0H7v5a2 2 0 0 1-2 2H0v11a1.97 1.97 0 0 0 1.934 2h12.132A1.97 1.97 0 0 0 16 18V2a1.97 1.97 0 0 0-1.934-2Zm-3 15H4.828a1 1 0 0 1 0-2h6.238a1 1 0 0 1 0 2Zm0-4H4.828a1 1 0 0 1 0-2h6.238a1 1 0 1 1 0 2Z"/>
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.98 2.98 0 0 0 .13 5H5Z"/>
                  </svg>
                  View full report
                </a>
              </div>
            </div>
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
                  show: false,
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
                  left: 2,
                  right: 2,
                  top: -26
                },
              },
              
              series: @json($chart),
              legend: {
                show: false
              },
              stroke: {
                curve: 'smooth'
              },
              xaxis: {
                categories: @json($date),
              },
              yaxis: {
                show: false,
              },
            }
      
            if (document.getElementById("line-chart") && typeof ApexCharts !== 'undefined') {
              const chart = new ApexCharts(document.getElementById("line-chart"), options);
              chart.render();
            }
          </script>
    </div>
</div>
