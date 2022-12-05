<div class="mt-4">

    <h2 class="font-bold text-2xl">Padres</h2>
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
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Dirección</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Celular</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Tel. Laboral</th>
                                <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-right"></th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">

                            @foreach ($padres as $item)
                                <tr>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ number_format($item->cedula, 0, ".", ".") }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-left">{{ $item->apellido }}, {{ $item->nombre }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->direccion }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->telefono_wapp }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-center">{{ $item->telefono_laboral }}</td>
                                    <td class="px-6 py-1 whitespace-nowrap text-lg text-gray-500 text-right">
                                        {{-- @can('madres.show') --}}
                                            <a onclick="todos({{$item->id}})" class="whitespace-nowrap text-lg mr-2"><i class='bx bx-edit-alt'></i></a>
                                        {{-- @endcan --}}
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    @include('ui.editar_madre_livewire')
    <div class="">
        {{$padres->links()}}
    </div>
    @push('js')

        <script>
            Livewire.on('ver_editar', function() {
                var titulo = 'Editar Padre';
                var pregunta = 'Desea editar los datos del Padre?';
                var titulo2 = 'Datos de la Madre';
                var siguiente = document.getElementById('editar_madre').innerHTML;
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
                                    var id = 1;
                                    var edit_id = Swal.getPopup().querySelector('#edit_id').value;
                                    var edit_cedula = Swal.getPopup().querySelector('#edit_cedula').value;
                                    var edit_nombre = Swal.getPopup().querySelector('#edit_nombre').value;
                                    var edit_apellido = Swal.getPopup().querySelector('#edit_apellido').value;
                                    var edit_telef_particular = Swal.getPopup().querySelector('#edit_telef_particular').value;
                                    var edit_telefono = Swal.getPopup().querySelector('#edit_telefono').value;
                                    var edit_direccion = Swal.getPopup().querySelector('#edit_direccion').value;
                                    var edit_trabajo = Swal.getPopup().querySelector('#edit_trabajo').value;
                                    var edit_dias = Swal.getPopup().querySelector('#edit_dias').value;
                                    var edit_telef_laboral = Swal.getPopup().querySelector('#edit_telef_laboral').value;

                                    axios.post('/editar_padres',  {
                                        id : id,
                                        edit_id : edit_id,
                                        edit_cedula : edit_cedula,
                                        edit_nombre : edit_nombre,
                                        edit_apellido : edit_apellido,
                                        edit_telef_particular : edit_telef_particular,
                                        edit_telefono : edit_telefono,
                                        edit_direccion : edit_direccion,
                                        edit_dias : edit_dias,
                                        edit_trabajo : edit_trabajo,
                                        edit_telef_laboral : edit_telef_laboral,
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
