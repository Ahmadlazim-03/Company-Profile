@extends('layouts.app')

@section('content')

    <section
        class="relative min-h-screen md:min-h-[500px] flex items-center justify-center bg-cover bg-center overflow-x-hidden"
        style="background-image: url('{{ asset('assets/bg-marketplace.png') }}');">
        <div class="relative z-10 text-center text-white px-4">

            <!-- Desktop image -->
            <div class="hidden md:block">
                <img src="{{ asset('assets/asset_marketplace.png') }}" alt="HIMTI Store Desktop" class="mx-auto rounded-lg">
            </div>

            <!-- Mobile text -->
            <div class="block md:hidden">
                <h1 class="text-[6rem] font-black -translate-x-18">
                    HIMTI
                </h1>
                <h2 class="text-5xl font-bold tracking-[0.2em] translate-x-8">
                    STORE
                </h2>
            </div>

        </div>
    </section>

    <div class="container mx-auto flex flex-col items-center">
        <h1 class="text-5xl font-bold text-blue-800 text-center mb-2 w-full pt-24">CATALOG</h1>

        <!-- Toolbar -->
        <div class="w-full flex flex-col sm:flex-row justify-between items-center gap-4">
            <!-- Search -->
            <form method="get" class="w-full">
                <input type="text"
                    class="w-full p-3 rounded-lg shadow-sm bg-zinc-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Search items...">
            </form>

            <!-- Actions -->
            <div class="flex flex-row gap-2 w-full sm:w-auto">
                <button
                    class="px-4 py-2 bg-gray-600 text-white rounded-lg shadow hover:bg-gray-700 transition w-full sm:w-auto">
                    Filter
                </button>
                <button
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition w-full sm:w-auto">
                    Sort
                </button>
            </div>
        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 w-full pb-12">
            @for ($i = 1; $i <= 8; $i++)
                <a href="/marketplace/baju-himti" class="block">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                        <img src="https://placehold.co/600x400" alt="Placeholder Image" class="w-full h-48 object-cover">
                        <div class="p-4 text-start">
                            <h2 class="text-lg font-semibold mb-2">Product {{ $i }}</h2>
                            <p class="text-blue-800 text-sm">Rp.{{ $i }}</p>
                        </div>
                    </div>
                </a>
            @endfor
        </div>
    </div>




@endsection