<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto">
            @include('transaction_stats')
        </div>
        <div class="mt-6 max-w-xl mx-auto sm:px-6 lg:px-8">
            @if(session('imported', false) === true)
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                    <span class="font-medium">Transactions have been imported.</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-blue-100 shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="relative flex items-center justify-center overflow-hidden">
                        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="block mb-4">
                                <input type="file" name="importFile"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-800 hover:file:bg-blue-500 hover:file:text-blue-100" />
                                @foreach ($errors->all() as $error)
                                    <div class="mt-4 text-red-600 text-sm">{{ $error }}</div>
                                @endforeach
                            </label>
                            <button type="submit"
                                    class="bg-sky-700 text-xl tracking-wider hover:bg-sky-900 font-bold text-white px-6 py-2 rounded-lg w-full">
                                Import
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
