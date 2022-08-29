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
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

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

            <div class="sidebar ">

                <div class="logo-details">
                    <i class='bx bxs-graduation'></i>
                    <span class="logo_name">Escuela</span>

                </div>

                <ul class="nav-links">

                    @can('alumno.index')
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
                    @endcan

                    @can('matricula.index')
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
                    @endcan

                    @can('consulta')

                        <li>
                            <div class="icon_link">
                                <a href="#">
                                    <i class='bx bx-book-reader'></i>
                                    <span class="link_name">Consultas</span>
                                </a>
                                <i class='bx bx-chevrons-down arrow'></i>
                            </div>
                            <ul class="sub-menu">
                                <li>
                                    <a class="link_name font-bold text-sm" href="#">Consultas</a>
                                </li>
                                @can('consulta.index')
                                    <li>
                                        <a class="" href="{{ route('consulta.index') }}">Grado - Turno</a>
                                    </li>
                                @endcan

                                @can('consulta.cobros_varios')
                                    <li>
                                        <a class="" href="{{ route('consulta.cobros_varios') }}">Ingreso Varios - Fecha</a>
                                    </li>
                                @endcan

                                {{-- <li>
                                    <a class="" href="{{ route('consulta.cobros_varios_alumno') }}">Ingreso Alumno</a>
                                </li> --}}
                                @can('consulta.cobros_varios_grado')
                                    <li>
                                        <a class="" href="{{ route('consulta.cobros_varios_grado') }}">Ingre. Varios Grado/Turno</a>
                                    </li>
                                @endcan

                                @can('consulta.cobros_cuota')
                                    <li>
                                        <a class="" href="{{ route('consulta.cobros_cuota') }}">Ingresos Cuota-Fecha</a>
                                    </li>
                                @endcan

                                @can('consulta.grado_consulta')
                                    <li>
                                        <a class="" href="{{ route('consulta.grado_consulta') }}">Ingresos Cuota-Grado</a>
                                    </li>
                                @endcan

                                @can('consulta.alumno_cuota_meses')
                                    <li>
                                        <a class="" href="{{ route('consulta.alumno_cuota_meses') }}">Cuotas Meses Pagados</a>
                                    </li>
                                @endcan

                            </ul>
                        </li>

                    @endcan

                    @can('tablasecundaria')

                        <li>
                            <div class="icon_link">
                                <a href="#">
                                    <i class='bx bx-book-reader'></i>
                                    <span class="link_name">Tablas Secundarias</span>
                                </a>
                                <i class='bx bx-chevrons-down arrow'></i>
                            </div>
                            <ul class="sub-menu">
                                @can('alergia.index')
                                    <li>
                                        <a class="" href="{{ route('alergia.index') }}">Alergia</a>
                                    </li>
                                @endcan

                                @can('lugarnacimiento.index')
                                    <li>
                                        <a class="" href="{{ route('lugarnacimiento.index') }}">Lugar de Nacimiento</a>
                                    </li>
                                @endcan

                                @can('seguro.index')
                                    <li>
                                        <a class="" href="{{ route('seguro.index') }}">Seguro</a>
                                    </li>
                                @endcan

                                @can('enfermedad.index')
                                    <li>
                                        <a class="" href="{{ route('enfermedad.index') }}">Enfermedad</a>
                                    </li>
                                @endcan

                                @can('pais.index')
                                    <li>
                                        <a class="" href="{{ route('pais.index') }}">Pais</a>
                                    </li>
                                @endcan

                                @can('nacionalidad.index')
                                    <li>
                                        <a class="" href="{{ route('nacionalidad.index') }}">Nacionalidad</a>
                                    </li>
                                @endcan

                                @can('parametro_general.index')
                                    <li>
                                        <a class="" href="{{ route('parametro_general.index') }}">Parametro G.</a>
                                    </li>
                                @endcan

                                @can('ciclo.index')
                                    <li>
                                        <a class="" href="{{ route('ciclo.index') }}">Ciclo</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                    @endcan

                    @can('anulacion.index')
                        <li>
                            <a href="{{ route('anulacion.index') }}">
                                <i class='bx bx-stats'></i>
                                <span class="link_name">Anulación</span>
                            </a>
                            <ul class="sub-menu blank">
                                <li>
                                    <a class="link_name" href="{{ route('anulacion.index') }}">Anulación</a>
                                </li>
                            </ul>

                        </li>
                    @endcan

                    @can('rol.index')
                        <li>
                            <a href="{{ route('rol.index') }}">
                                <i class='bx bxs-group'></i>
                                <span class="link_name">Grupo de Usuario</span>
                            </a>
                            <ul class="sub-menu blank">
                                <li>
                                    <a class="link_name" href="{{ route('rol.index') }}">Grupo de Usuario</a>
                                </li>
                            </ul>

                        </li>
                    @endcan

                    @can('usuario.index')
                        <li>
                            <a href="{{ route('usuario.index') }}">
                                <i class='bx bxs-user-circle'></i>
                                <span class="link_name">Usuarios</span>
                            </a>
                            <ul class="sub-menu blank">
                                <li>
                                    <a class="link_name" href="{{ route('usuario.index') }}">Usuarios</a>
                                </li>
                            </ul>

                        </li>
                    @endcan

                    <li>
                        <a href="{{ route('usuario.pass') }}">
                            <i class='bx bx-reset'></i>
                            <span class="link_name">Password</span>
                        </a>
                        <ul class="sub-menu blank">
                            <li>
                                <a class="link_name" href="{{ route('usuario.pass') }}">Password</a>
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
            <main class="body-content ">
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

        @stack('js')
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>
        <script src="{{ asset('js/dashboard.js') }}"></script>
        <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
        <script src="https://unpkg.com/axios/dist/axios.min.js" defer></script>

    </body>
</html>
