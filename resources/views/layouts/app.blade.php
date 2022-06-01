<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        @livewireStyles
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />

        @yield('style')
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}
    </head>

    <body class="font-sans antialiased">
        {{-- <x-jet-banner /> --}}
        <header>

            <div class="sidebar close">

                <div class="logo-details">
                    <i class='bx bxs-graduation'></i>
                    <span class="logo_name">Escuela</span>

                </div>

                <ul class="nav-links">

                    <li>
                        <a href="{{ route('alumno.index') }}">
                            <i class='bx bx-id-card'></i>
                            <span class="link_name">Alumnos</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a class="link_name" href="{{ route('alumno.index') }}">Alumnos</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <a href="{{ route('matricula.index') }}">
                            <i class='bx bx-task'></i>
                            <span class="link_name">Matricula</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a class="link_name" href="{{ route('matricula.index') }}">Matricula</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <div class="icon_link">
                            <a href="#">
                                <i class='bx bxs-collection'></i>
                                <span class="link_name">Categoria</span>
                            </a>
                            <i class='bx bx-chevrons-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li>
                                <a class="link_name" href="#">Web Desing</a>
                            </li>
                            <li>
                                <a class="" href="#">Web Desing 1</a>
                            </li>
                            <li>
                                <a class="" href="#">Web Desing 2</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <div class="icon_link">
                            <a href="#">
                                <i class='bx bxs-collection'></i>
                                <span class="link_name">Post</span>
                            </a>
                            <i class='bx bx-chevrons-down arrow'></i>
                        </div>
                        <ul class="sub-menu">
                            <li>
                                <a class="link_name" href="#">PHP</a>
                            </li>
                            <li>
                                <a class="" href="#">CSS</a>
                            </li>
                            <li>
                                <a class="" href="#">HTML</a>
                            </li>

                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bx-grid-alt'></i>
                            <span class="link_name">Analisis</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a class="link_name" href="#">Analisis</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <a href="#">
                            <i class='bx bx-grid-alt'></i>
                            <span class="link_name">JS</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a class="link_name" href="#">JS</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <div class="profile-details">
                            <div class="profile-content">
                                <img src="{{ Storage::url('user.png') }}" alt="user">
                            </div>
                            <div class="name-job">
                                <div class="profile_name">{{Auth::user()->name}}</div>
                                <div class="job">Programador</div>
                            </div>

                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                @method('post')
                                {{-- <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2"><i class='bx bx-log-out'></i></a> --}}
                                <button  type="submit" class="block px-4 py-2 text-sm text-gray-700"><i class='bx bx-log-out'></i></button>
                            </form>

                        </div>
                    </li>

                </ul>


            </div>

            <section class="home-section">
                <div class="home-content">
                    <i class="bx bx-menu"></i>
                    <span class="text"></span>
                </div>
            </section>
        </header>
        <div class="bg-gray-100 mb-20 h-full">
            {{-- @livewire('navigation-menu') --}}

            <!-- Page Heading -->
            {{-- @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif --}}

            <!-- Page Content -->
            <main class="body-content close">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-200 font-semibold text-red-900 text-sm rounded px-4 py-3 mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-200 font-semibold text-green-900 text-sm rounded px-4 py-3 mb-6">
                        {{ session()->get('message') }}
                    </div>
                @endif

                {{ $slot }}
            </main>
        </div>
        @stack('modals')

        @livewireScripts
        <script src="https://code.jquery.com/jquery-1.9.1.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>


    </body>
</html>
