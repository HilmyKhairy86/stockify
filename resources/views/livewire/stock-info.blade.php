<div class="overflow-x-auto w-full">
    <h3 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Stock Menipis</h3>
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
              Stock
            </th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-gray-800">
          @foreach ($product as $p)  
            <tr>
              <td class="p-4 text-sm font-normal text-gray-900 whitespace-nowrap dark:text-white">
                {{$p->name}}
              </td>
              <td class="p-4 text-sm font-normal text-gray-500 whitespace-nowrap dark:text-gray-400">
                {{$p->sku}}
              </td>
              <td class="p-4 text-sm font-semibold text-red-700 dark:text-red-700 whitespace-nowrap ">
                @if ($p->stock < 10)
                <i class="fa-solid fa-triangle-exclamation mx-3"></i>{{$p->stock}}
                @else
                <i class="fa-solid fa-caret-down mx-3"></i>{{$p->stock}}
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
    </table>
    @empty ($product->links())
    @else
    {{$product->links('pagination::tailwind')}}
    @endempty
</div>
