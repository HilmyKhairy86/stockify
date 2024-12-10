<div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
    <div class="p-5">
        <div class="">
            <h2 class="mb-5 text-5xl font-bold text-gray-900 dark:text-white">User Activity</h2>
            {{-- <p class="text-md text-gray-900">Date : {{ today() }}</p> --}}
        </div>
        @if (request()->routeIs('admin.UserActivity'))    
        <div  class="relative mb-3">
            <form action="{{ route('admin.exportpdfact') }}" method="post">
            @csrf
            <button type="submit" class="flex items-center justify-center dark:bg-blue-600 bg-blue-600 text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                <i class="fa-solid fa-file-export mx-1"></i>
                Export to PDF
            </button>
            </form>
        </div>
        @endif
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">User</th>
                        <th scope="col" class="px-4 py-3">Activity</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $index => $d)
                    <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                        <td class="px-4 py-3">{{ $data->firstItem() + $index}}</td>
                        <td class="px-4 py-3">{{ $d->user_id }} - {{ $d->user->name }}</td>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $d->kegiatan }}
                        </th>
                        <th scope="row" class="px-4 py-3 font-medium text-gray-900 dark:text-white">
                            {{ $d->tanggal }}
                        </th>
                    </tr>
                    @endforeach
                    <!--Update Main modal -->
                </tbody>
            </table>
            @empty ($data->links())
            @else
            {{$data->links('pagination::tailwind')}}
            @endempty
        </div>
    </div>
</div>
