<div class="mt-4">

    <h2 class="font-bold text-2xl">Matriculación</h2>
    <div class="mt-4 mb-4">
        <input type="text" wire:model="search" class="w-full border-gray-300 rounded" placeholder="Numero de cedula...">
    </div>

    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Documento</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Apellido y Nombre</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Grado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Turno</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">ciclo</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Estado</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($matricula as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ number_format($item->alumnos->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-left">{{ $item->alumnos->apellido }}, {{ $item->alumnos->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->grado->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->turno->nombre }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">{{ $item->ciclo->año }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        <a
                                        wire:click="$emit('anular', {{$item->id}})"
                                        class= "text-green-500 font-bold"
                                        >  {{ $item->estado->nombre }}</a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                        @can('matricula.show')
                                            <a href="{{ route('matricula.show', $item) }}" class="whitespace-nowrap text-sm mr-2"><i class='bx bx-coin-stack'></i></a>
                                        @endcan

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>

    <div class="">
        {{$matricula->links()}}
    </div>


    @push('js')

        <script>

            window.addEventListener('load', function() {
                window.livewire.on('exito', msj => {
                    Swal.fire(
                        'Anular Matricula',
                        'Se ha anulado con exito la matricula!.',
                        'success'
                    )
                });

                window.livewire.on('fallo', msj => {
                    Swal.fire(
                        'Anular Matricula',
                        'No se ha podido anular la matricula!.',
                        'warning'
                    )
                });
            });

            Livewire.on('anular', matricula_id => {

                Swal.fire({
                    title: 'Anular Matricula',
                    text: 'Desea anular matricula?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('matricula-index', 'anular_matricula', matricula_id);

                        // Swal.fire(
                        //     'Anular Matricula',
                        //     'Se ha anulado con exito la matricula!.',
                        //     'success'
                        // )
                    }
                })
            });
        </script>

    @endpush

</div>
