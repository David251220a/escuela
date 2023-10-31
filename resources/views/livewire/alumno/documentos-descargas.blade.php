<div>
    <div class="flex flex-col mb-4">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <h2 class="text-gray-500 text-lg font-bold mt-2 mb-2">Documentos Importantes</h2>
                    <table class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                        <thead class="bg-gray-50">
                            @foreach ($data as $item)
                                <tr>
                                    <th width="90" scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        {{$item->descripcion}}
                                    </th>
                                    <th width="5" scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        <a href="{{Storage::url($item->pdf)}}" wire:click="actualizar({{$item->id}})" download="{{$item->descripcion}}.pdf" class="text-xl">
                                            <i class='bx bx-download'></i>
                                        </a>
                                    </th>
                                    <th width="5" scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">
                                        @if ($item->leido == 0)
                                            <i class='bx bxs-error-circle text-lg text-red-600'></i>
                                        @else
                                            <i class='bx bxs-check-square text-lg text-green-600'></i>
                                        @endif

                                    </th>
                                </tr>
                            @endforeach

                        </thead>
                    </table>

                </div>

            </div>

        </div>

    </div>
</div>
