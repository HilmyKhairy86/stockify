@section('title', 'Profile')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <!-- Modal toggle -->
        <div x-data="{ isOpen: true }" @keydown.escape.window="open = false" x-bind:class="{ 'overflow-y-hidden': open }">
            <!-- Modal -->
            <div 
                x-show="isOpen" 
                @click.self="isOpen = false"
                class="fixed inset-0 z-50 flex items-center justify-center w-full h-screen bg-black bg-opacity-50"
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0"
                                    x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100"
                                    x-transition:leave-end="opacity-0"
            >
                <div class="relative p-4 w-full max-w-2xl bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Success!
                        </h3>
                        <button 
                            @click="isOpen = false" 
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white"
                        >
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal Body -->
                    <div class="p-4 text-center">
                        <h3 class="text-4xl font-semibold text-gray-900 dark:text-white">
                            Action Success!
                        </h3>
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button 
                            @click="isOpen = false" 
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto md:px-5 sm:px-5 lg:px-5">
            <!-- Start coding here -->
            <div class="mb-5 border dark:border-gray-800 dark:bg-gray-800 rounded-lg shadow-lg bg-white border-gray-200">
                <div class="p-5">
                    <h2 class="mb-2 text-5xl font-bold text-gray-900 dark:text-white">Profile</h2>
                    {{-- <h2 class="mb-2 text-xl font-bold text-gray-900 dark:text-white">Halo, {{auth()->user()->name}}</h2> --}}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                {{-- content --}}
                <div class="mb-3">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                        <form action="" method="post">
                            @csrf
                            {{-- @if ($d->image) --}}
                            <div class="sm:col-span-2">
                                <img for="image" src="{{ asset('storage/' ) }}" class="block w-full h-full object-cover rounded-lg border border-gray-600" />
                            </div>
                            {{-- @endif --}}
                            <div class="grid gap-4 mb-4 p-2">
                                <div class="sm:col-span-2">
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $data->name }}" placeholder="Type user name" required="">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="email" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $data->email }}" placeholder="Type user email" required="">
                                </div>
                                
                                <div class="sm:col-span-2">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password"
                                        x-model="password" 
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type password" required=""
                                    >
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="confirmPassword"
                                        x-model="confirmPassword"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type password" required="">
                                </div>
                                <div x-show="password && confirmPassword" class="sm:col-span-2">
                                    <p x-text="passwordsMatch ? 'Passwords match!' : 'Passwords do not match.'" 
                                       :class="passwordsMatch ? 'text-green-600' : 'text-red-600'">
                                    </p>
                                </div>
                            </div>
                            <script>
                                function passwordChecker() {
                                    return {
                                        password: '',
                                        confirmPassword: '',
                                        get passwordsMatch() {
                                            return this.password === this.confirmPassword;
                                        },
                                        submitForm() {
                                            if (this.passwordsMatch) {
                                                alert('Passwords match. Form submitted!');
                                            } else {
                                                alert('Passwords do not match. Please try again.');
                                            }
                                        }
                                    };
                                }
                            </script>
                            <div class="flex items-center space-x-4">
                                <button type="submit" :disabled="!passwordsMatch" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                    Save Setting
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
  
</x-app-layout>


