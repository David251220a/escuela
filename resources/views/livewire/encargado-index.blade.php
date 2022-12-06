<div class="mt-4">

    <h2 class="font-bold text-2xl">Encargados</h2>
    <div class="mt-4 mb-4">
        <input type="text" wire:model="search" class="w-full border-gray-300 rounded" placeholder="Numero de cedula..." >
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
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Parentezco</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Celular</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Observación</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($encargados as $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-left">{{ $item->nombre }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->parentezco }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->telefono }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->observacion }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-right">
                                        @can('padre.edit')
                                            <a onclick="encargado_livewire({{$item->id}})" class="whitespace-nowrap text-lg mr-2"><i class='bx bx-edit-alt'></i></a>
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
    @include('ui.editar_encargado_livewire')
    <div class="">
        {{$encargados->links()}}
    </div>
    @push('js')

    <script>
        Livewire.on('ver_editar', function() {
            var titulo = 'Editar Encargado';
            var pregunta = 'Desea editar los datos del Encargado?';
            var titulo2 = 'Datos del Encargado';
            var siguiente = document.getElementById('editar_encargado1').innerHTML;
            Swal.fire({
                title: titulo,
                text: pregunta,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si'
            }).then(resultado => {
                if (resultado.value) {
                    Swal.fire({
                        title: '<u>'+ titulo2+'</u>',
                        html:
                        siguiente,
                        width: 800,
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Guardar',

                        }).then(resultado => {
                            if (resultado.value) {
                                var cedula = Swal.getPopup().querySelector('#edit_cedula_en').value;
                                var nombre = Swal.getPopup().querySelector('#edit_nombre_en').value;
                                var parentezo = Swal.getPopup().querySelector('#endit_parentezco_en').value;
                                var telefono = Swal.getPopup().querySelector('#edit_telef_en').value;
                                var observacion_encargado = Swal.getPopup().querySelector('#edit_observacion_en').value;
                                var edit_id = Swal.getPopup().querySelector('#edit_id').value;

                                axios.post('/editar_encargados',  {
                                    cedula : cedula,
                                    edit_id : edit_id,
                                    nombre : nombre,
                                    parentezo : parentezo,
                                    telefono : telefono,
                                    observacion_encargado : observacion_encargado,
                                })
                                .then(respuesta => {
                                    if(respuesta.data.ok == 1){
                                        Swal.fire(
                                            titulo2,
                                            respuesta.data.mensaje,
                                            'success'
                                        )
                                        Livewire.emit('render');
                                    }else{
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Oops...',
                                            text: respuesta.data.mensaje,
                                        })
                                    }

                                })
                                .catch(error => {
                                    console.log(error);
                                })
                            }

                    })
                }
            })
        });
    </script>

@endpush

</div>
