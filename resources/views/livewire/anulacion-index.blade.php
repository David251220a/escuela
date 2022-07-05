<div>
    <h2 class="font-bold text-gray-500 text-2xl">Listado de Alumnos</h2>
    <div class="mt-4 mb-4">
        <input type="text" wire:model="search" class="w-full border-gray-300 rounded" placeholder="Busqueda...">
    </div>

    <div class="flex justify-center mb-6">
        <div class="form-check form-check-inline mr-4">
            <input wire:model="activo" class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
            border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
            duration-200 mt-2 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
            type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
            <label class="form-check-label inline-block text-gray-800 text-lg" for="inlineRadio10">Alumnos Activos</label>
        </div>
        <div class="form-check form-check-inline">
            <input wire:model="activo" class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
            border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
            duration-200 mt-2 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
            type="radio" name="inlineRadioOptions" id="inlineRadio2" value="2">
            <label class="form-check-label inline-block text-gray-800 text-lg" for="inlineRadio20">Alumnos Inactivos</label>
        </div>
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Documento</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-left">Apellido y Nombre</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Grado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Turno</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Estado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $si = 0;
                            @endphp
                            @foreach ($alumnos as $item)
                                <tr class="{{ ($si == 1 ? 'bg-blue-100' : '') }}">
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $item->grado->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">{{ $item->turno->nombre }}</td>
                                    <td class="px-6 whitespace-nowrap text-sm text-black font-semibold text-center">
                                        @can('alumno.delete')
                                            <a wire:click="$emit('cambio_activo_alumno', {{$item->id}})"
                                            class="{{ ($item->estado->id == 1 ? 'text-green-600' : 'text-red-600') }} font-bold text-sm text-center">
                                                {{ $item->estado->nombre }}
                                            </a>
                                        @endcan
                                    </td>

                                    <td>
                                        @can('anulacion.show')
                                            <a href="{{ route('anulacion.show', $item) }}" class="whitespace-nowrap text-2xl mr-2 tip">
                                                <i class='bx bx-search-alt-2'></i>
                                                <span>Ingresos</span>
                                            </a>
                                        @endcan

                                    </td>

                                </tr>
                                @php
                                    if($si == 0){
                                        $si = 1;
                                    }else {
                                        $si = 0;
                                    }
                                @endphp
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="">
        {{$alumnos->links()}}
    </div>

    @push('js')
        <script>
            Livewire.on('cambio_activo_alumno', alumno_id => {

                Swal.fire({
                    title: 'Cambio de Estado Alumno',
                    text: 'Desea cambiar de estado?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('anulacion-index', 'cambio_activo', alumno_id);

                        Swal.fire(
                            'Deshabilitar Alumno',
                            'Se ha deshabilitado con exito el alumno!.',
                            'success'
                        )
                    }
                })
            });

        </script>
    @endpush

</div>
