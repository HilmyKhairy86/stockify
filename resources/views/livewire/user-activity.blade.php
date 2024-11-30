<div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
    <div class="p-5">
        <div class="p-5">
            <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">User Activity</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-300 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">User</th>
                        <th scope="col" class="px-4 py-3">Activity</th>
                        <th scope="col" class="px-4 py-3">Date</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- {{dd($stock)}} --}}
                    @foreach ($data as $d)
                    <tr class="border-b dark:border-gray-700 odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800">
                        <td class="px-4 py-3 text-center">{{ $d->user_id }} - {{ $d->user->name }}</td>
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