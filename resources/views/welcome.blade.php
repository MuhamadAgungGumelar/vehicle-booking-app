<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.8.2/alpine.js" defer></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        @include('sweetalert::alert')
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="bg-gray-50 text-black/50 h-screen w-full">
                @if (Route::has('login'))
                    <nav class="flex justify-end items-center border border-1 relative z-10 py-6 px-20">
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="rounded-md px-3 py-2 text-black font-bold ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="rounded-md px-3 py-2 text-black font-bold ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                            >
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a
                                    href="{{ route('register') }}"
                                    class="rounded-md px-3 py-2 text-black font-bold ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                >
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            
            <main class="mt-20 flex flex-col md:flex-row justify-between items-center w-full ">
                <section class="flex flex-col justify-center items-center gap-2 px-52">
                    <h1 class="font-extrabold text-5xl mb-4 text-slate-800">Welcome to Our Mining Company</h1>
                    <p class="mb-8 font-bold text-xl text-slate-400">Pioneering the future of mining with innovation and sustainability.</p>
                </section>

                <section class="grid grid-cols-1 md:grid-cols-2 w-72 md:w-fit md:py-6 md:px-20 h-fit gap-4">
                    <img id="background" class="top-0 left-0 max-w-xl w-full h-full object-cover rounded-lg" src="{{ URL('images/background.jpg') }}" />

                    <div class="flex flex-col gap-4">
                        <img id="background" class="top-0 left-0 max-w-xl w-full h-fit object-cover rounded-lg" src="{{ URL('images/background2.jpg') }}" />
                        <img id="background" class="top-0 left-0 max-w-xl w-full h-fit max-h-72 object-cover rounded-lg" src="{{ URL('images/background3.jpg') }}" />
                    </div>
                </section>
            </main>
        </div>
    </body>

</html>
