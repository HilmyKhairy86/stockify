<div class="grid grid-cols-2 xl:grid-cols-2 xl:gap-4">
    <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
        <div class="p-5">
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                  <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Jumlah Produk Masuk</h5>
                  </div>
                </div>
                {{--  --}}
                <div>
                    <div class="p-5">
                        <h3 class="text-8xl font-bold text-gray-700 dark:text-gray-100">{{$masuk}}</h3>
                    </div>
                </div>
                <div class="w-full items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                  <div class="flex justify-between items-center pt-5">
                    <select wire:model.live="filtermasuk" id="underline_select" class="text-md dark:bg-gray-800 py-2.5 px-0 text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="day" selected>Sehari</option>
                        <option value="week">Seminggu</option>
                        <option value="month">Sebulan</option>
                        <option value="year">Setahun</option>
                    </select>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
        <div class="p-5">
            <div class="w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                  <div>
                    <h5 class="leading-none text-3xl font-bold text-gray-900 dark:text-white pb-2">Jumlah Produk Keluar</h5>
                  </div>
                </div>
                {{--  --}}
                <div>
                    <div class="p-5">
                        <h3 class="text-8xl font-bold text-gray-700 dark:text-gray-100">{{$keluar}}</h3>
                    </div>
                </div>
                <div class="w-full items-center border-gray-200 border-t dark:border-gray-700 justify-between">
                  <div class="flex justify-between items-center pt-5">
                    <select wire:model.live="filterkeluar" id="underline_select" class="dark:bg-gray-800 py-2.5 px-0 text-md text-gray-500 bg-transparent border-0 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                        <option value="day" selected>Sehari</option>
                        <option value="week">Seminggu</option>
                        <option value="month">Sebulan</option>
                        <option value="year">Setahun</option>
                    </select>
                  </div>
                </div>
            </div>
            {{-- <h3 class="text-xl font-normal text-gray-700 dark:text-gray-400">Jumlah Produk Keluar</h3>
            <h3 class="text-base font-light text-gray-500 dark:text-gray-400">Dalam waktu 
                <select wire:model.live="filterkeluar" id="underline_select" class="dark:bg-gray-800 py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                    <option value="day" selected>Sehari</option>
                    <option value="week">Seminggu</option>
                    <option value="month">Sebulan</option>
                    <option value="year">Setahun</option>
                </select>
            </h3> --}}
            
            {{-- <div class="p-5">
                <h3 class="text-8xl font-bold text-gray-700 dark:text-gray-100">{{$keluar}}</h3>
            </div> --}}
        </div>
    </div>
</div>
