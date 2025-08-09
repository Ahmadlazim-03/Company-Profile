@extends('layouts.app')

@section('content')


    <section class="bg-white min-h-screen flex items-center py-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white shadow-xl rounded-lg overflow-hidden flex flex-col md:flex-row">

                <div class="md:w-1/2">
                    <img src="https://placehold.co/1000x800/E2E8F0/334155?text=Jaket+HIMA" alt="Jaket HIMA berwarna biru"
                        class="w-full h-full object-cover">
                </div>

                <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-between">
                    <div>
                        <h1 class="text-4xl lg:text-5xl font-bold text-gray-800 mb-4">Jaket HIMA</h1>
                        <h2 class="text-3xl font-bold text-blue-800 mb-6">Rp.190.000</h2>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sed ligula eu ex
                            malesuada
                            faucibus quis quis lacus. Vivamus imperdiet ligula vel est fermentum, ac sagittis eros
                            pulvinar.
                            Donec interdum ultricies felis, ac volutpat arcu imperdiet a.
                        </p>
                    </div>
                    <a href="#"
                        class="block w-full md:w-auto px-8 py-3 bg-blue-800 text-white font-semibold rounded-lg shadow-md text-center hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Beli Sekarang
                    </a>
                </div>
            </article>
        </div>
    </section>

    <section class="bg-gray-50 mt-24">

        <!-- title -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Produk Rekomendasi</h2>
            <p class="text-gray-600 mt-2">Pilihan terbaik untuk Anda</p>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 mb-24">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @for ($i = 1; $i <= 4; $i++)
                    <div class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="https://placehold.co/600x400" alt="cover{{ $i }}" class="w-full object-cover h-48">
                        <div class="p-4">
                            <h3 class="text-xl font-bold">Barang {{ $i }}</h3>
                            <p class="text-gray-600 mt-1">A longer description that wraps naturally.</p>
                            <div class="mt-4">
                                <a href="#"
                                    class="block w-full md:w-auto px-8 py-2 bg-blue-800 text-white font-semibold rounded-lg shadow-md text-center hover:bg-blue-700 transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Beli Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>





@endsection