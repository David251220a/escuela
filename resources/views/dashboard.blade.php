<x-app-layout>

    @section('style')
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.1/dist/flowbite.min.css" />
    @endsection

    <div class="mb-4 font-bold uppercase text-2xl text-gray-700">

        <div class="header">
            <h1>"ESCUELA HUERTO GETSEMANI"</h1>
        </div>

    </div>

    @can('user.alumno')
        @livewire('alumno.documentos-descargas')
    @endcan

</x-app-layout>
