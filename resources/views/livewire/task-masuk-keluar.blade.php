<div class="grid grid-cols-1 my-4 xl:grid-cols-2 xl:gap-4">
    <!-- Activity Card -->
    <div class="p-4 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 sm:p-6 dark:bg-gray-800 xl:mb-0">
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
                  Type
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
                  <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                    {{$m->type}}
                  </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @empty ($masuk->links())
                @else
                {{$masuk->links('pagination::tailwind')}}
        @endempty
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
                <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                  {{$k->type}}
                </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        @empty ($keluar->links())
        @else
        {{$keluar->links('pagination::default')}}
        @endempty
      </div>
</div>

