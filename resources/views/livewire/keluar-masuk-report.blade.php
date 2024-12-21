<div class="">
    <!-- Activity Card -->
    <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
      <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Product Masuk</h3>
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
          <thead class="bg-gray-50 dark:bg-gray-700">
            <tr>
              <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                Product Name
              </th>
              <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                SKU
              </th>
              <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
                Status
              </th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800">
              @foreach ($masuk as $m) 
              <tr>
                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                  {{$m->product->name}}
                </td>
                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                  {{$m->product->sku}}
                </td>
                <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                  @switch($m->status)
                      @case('pending')
                          <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-600 dark:text-yellow-200">
                              <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                              Pending
                          </span>
                          @break
                      @case('diterima')
                          <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                              <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                              Diterima
                          </span>
                          @break
                      @case('ditolak')
                          <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                              <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                              Ditolak
                          </span>
                          @break
                      @case('dikeluarkan')
                          <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                              <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                              Dikeluarkan
                          </span>
                          @break
                      @default
                  @endswitch
                </td>
              </tr>
              @endforeach
          </tbody>
      </table>
      {{$masuk->links('pagination::tailwind')}}
    </div>
    
    <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800">
      <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Product Keluar</h3>
      <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
        <thead class="bg-gray-50 dark:bg-gray-700">
          <tr>
            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
              Product Name
            </th>
            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
              SKU
            </th>
            <th scope="col" class="p-4 text-xs font-medium tracking-wider text-left text-gray-500 uppercase dark:text-white">
              Status
            </th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
            @foreach ($keluar as $k) 
            <tr>
              <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                {{$k->product->name}}
              </td>
              <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                {{$k->product->sku}}
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                @switch($k->status)
                    @case('pending')
                        <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-yellow-600 dark:text-yellow-200">
                            <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full"></span>
                            Pending
                        </span>
                        @break
                    @case('diterima')
                        <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                            <span class="w-2 h-2 me-1 bg-green-500 rounded-full"></span>
                            Diterima
                        </span>
                        @break
                    @case('ditolak')
                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                            Ditolak
                        </span>
                        @break
                    @case('dikeluarkan')
                        <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                            <span class="w-2 h-2 me-1 bg-red-500 rounded-full"></span>
                            Dikeluarkan
                        </span>
                        @break
                    @default
                @endswitch
              </td>
            </tr>
            @endforeach
        </tbody>
      </table>
      {{$keluar->links('pagination::tailwind')}}
    </div>
</div>
