<x-app-layout>

    <h2 class="text-xl text-gray-500 font-semibold mb-2">Nueva Matricula</h2>

    <form action=" {{ route('matricula.store') }} " method="POST">

        @csrf

        <div class="mb-4 border-b border-gray-200">

            <div class="md:grid grid-cols-4 gap-4 px-4 py-6">

                <div class="mb-4">
                    <label for="">Cedula Alumno</label>
                    <input type="text" name="cedula" id="cedula"  class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('cedula') }}" onkeyup="format(this)" onchange="format(this)" placeholder="Cedula..."  >
                    <span>
                        <p class="text-red-500 text-left text-sm font-semibold">Presione enter para validar numero de cedula</p>
                    </span>
                </div>

                <div class="mb-4">
                    <label for="">Nombre</label>
                    <input type="text" name="nombre_apellido" id="nombre_apellido" class="w-full rounded border-gray-400 enviar enviar"
                    value="{{ old('nombre_apellido', "SIN ESPECIFICAR") }}" readonly>
                </div>

                <div class="mb-4">
                    <label for="">Grado</label>
                    <select name="grado" id="grado" class="w-full rounded border-gray-400 enviar">
                        @foreach ($grado as $item)
                            <option {{ (old('grado') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Turno</label>
                    <select name="turno" id="turno" class="w-full rounded border-gray-400 enviar">
                        @foreach ($turno as $item)
                            <option {{ (old('turno') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Ciclo</label>
                    <select name="ciclo" id="ciclo" class="w-full rounded border-gray-400 enviar">
                        @foreach ($ciclo as $item)
                            <option {{ (old('ciclo') == $item->id ? 'selected' : '' ) }} value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="">Monto Matricula</label>
                    <input type="text" name="matricula" id="matricula" class="w-full rounded border-gray-400 enviar text-right"
                    onkeyup="format(this)" onchange="format(this)" value="{{ old('matricula', 0) }}" required>
                </div>

                <div class="mb-4">
                    <label for="">Monto Cuota</label>
                    <input type="text" name="monto_cuota" id="monto_cuota" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('monto_cuota', 0) }}" onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4">
                    <label for="">Fecha Inicio (Cuota)</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full rounded border-gray-400 enviar" value="{{ old('fecha_inicio') }}">
                </div>

                <div class="mb-4">
                    <label for="">Cantidad_Cuota</label>
                    <input type="number" name="cantidad_cuota" id="cantidad_cuota" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('cantidad_cuota', 0) }}">
                </div>

                <div class="mb-4 mt-6">
                    <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm
                    bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                    duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                    type="checkbox" value="0" id="paga_matricula" name="paga_matricula" onclick="check_paga_matricula()">
                    <label class="form-check-label inline-block text-gray-800 font-bold" for="flexCheckDefault">
                        Pagar Matricula
                    </label>

                </div>

                <div class="mb-4" id="h_matricula_cobrar" style="display: none">
                    <label for="">Matricula a Cobrar</label>
                    <input type="text" name="matricula_cobrar" id="matricula_cobrar" class="w-full rounded border-gray-400 enviar text-right"
                    value="{{ old('matricula_cobrar', 0) }}" onkeyup="format(this)" onchange="format(this)">
                </div>

                <div class="mb-4" id="h_tipo_cobro" style="display: none">
                    <label for="">Tipo de Cobro</label>
                    <select name="tipo_cobro" id="tipo_cobro" class="w-full rounded border-gray-400 enviar">
                        @foreach ($tipo_cobro as $item)
                            <option {{ (old('tipo_cobro') == $item->id ? 'selected' : '' ) }}  value="{{ $item->id }}">{{ $item->nombre }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="mb-4">
                    <button type="button" id="generar" name="generar" class="mt-6 inline-block px-6 py-2.5 bg-green-500 text-white
                    font-medium text-xs leading-tight uppercase rounded-full shadow-md hover:bg-green-600 hover:shadow-lg
                    focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out"
                    onclick="btn_generar()">
                    Generar Cuota
                    </button>
                </div>

            </div>

        </div>

        <div class="flex flex-col mb-4">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                        <table id="generacion_cuota" name="generacion_cuota" class="min-w-full divide-y divide-gray-200 rounded overflow-hidden shadow">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Cuota</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Fecha Vencimiento</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota</th>
                                    <th scope="col" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider text-center">Monto Cuota Cobrado</th>
                                </tr>
                            </thead>

                            <tbody id="generacion_cuota_body">

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4 pl-4">
            <button type="submit"
            class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded
            shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700
            active:shadow-lg transition duration-150 ease-in-out"
             value="">Guardar</button>
        </div>

    </form>

    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/moment_locale.js') }}"></script>

    <script>
        var element = document.querySelectorAll('.enviar');
        document.addEventListener('keydown', (event) => {
            if (event.key == 'Enter') {
                event.preventDefault();
                if(event.target.id == 'cedula'){
                    cedula = document.getElementById('cedula').value;
                    if((cedula == 0) || (cedula == '')) {
                        document.getElementById('nombre_apellido').value = 'SIN ESPECIFICAR';
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'El numero de cedula no puede estar vacio o ser "0"!!.',
                        })
                    }else{
                        axios.post('/buscar_alumno',  {
                            cedula : cedula
                        })
                        .then(respuesta => {
                            if(JSON.stringify(respuesta.data)=='{}'){
                                document.getElementById('nombre_apellido').value = 'SIN ESPECIFICAR';
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'No se encuentra alumno con este N° de cedula: ' + cedula,
                                })
                            }else{
                                document.getElementById('nombre_apellido').value = respuesta.data.nombre+' '+ respuesta.data.apellido;
                            }
                        })
                        .catch(error => {
                            console.log(error);

                        })
                    }
                }
            }
        })

        function format(input){
            var num = input.value.replace(/\./g,'');
            if(!isNaN(num)){
                if(num == ''){
                    input.value = "0";
                }else{
                    num = parseInt(num);
                    num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                    num = num.split('').reverse().join('').replace(/^[\.]/,'');
                    input.value = num;
                }

            }
            else{
                input.value = input.value.replace(/[^\d\.]*/g,'');
            }
        }

        function btn_generar(){
            index = 0;
            index_1 = 0;
            grado = document.getElementById('grado');
            turno = document.getElementById('turno');
            nombre_alumno = document.getElementById('nombre_apellido').value;
            monto_cuota = document.getElementById('monto_cuota').value;
            fecha_inicio = document.getElementById('fecha_inicio').value;
            cantidad_cuota = document.getElementById('cantidad_cuota').value;

            $("#generacion_cuota > tbody").empty();

            index = grado.selectedIndex;
            var grado_id = 1;
            grado_id = grado.options[index].value;

            index_1 = turno.selectedIndex;
            var turno_id = 1;
            turno_id = turno.options[index_1].value;

            if(grado_id == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe elegir un grado para poder generar cuota.',
                })
            }

            if(nombre_alumno == 'SIN ESPECIFICAR'){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe elegir un alumno para poder generar cuota.',
                })
            }

            if(turno_id == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe elegir un turno para poder generar cuota.',
                })
            }

            if((monto_cuota == 0) || (monto_cuota == '')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'El monto cuota debe ser mayor a 0 para poder generar cuota.',
                })
            }
            fecha_inicio = moment(fecha_inicio);
            var now = moment();
            if(fecha_inicio.year() != now.year()){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La año de la fecha de inicio deberia ser de este año.',
                })
            }

            if(cantidad_cuota <= 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La cantidad de cuota no puede ser menor o igual a 0!!.',
                })
            }
            var cont = 0;
            for (let i = 0; i < cantidad_cuota; i++) {

                lastmonthlastdate = moment(fecha_inicio).endOf('month').format('DD-MM-YYYY');
                cont++;
                document.getElementById("generacion_cuota_body").insertRow(-1).innerHTML = '<tr>\
                                                                                            <td class"text-center"><input type="text" class="text-center w-full border-gray-100" value="'+cont+'" readonly> </td>\
                                                                                            <td class"text-center"><input type="text" class="text-center w-full border-gray-100" name="fecha_cuota[]" value="'+lastmonthlastdate+'" readonly> </td>\
                                                                                            <td class"text-center"><input type="text" class="text-center w-full border-gray-100" value="'+monto_cuota+'" readonly></td>\
                                                                                            <td class"text-center"><input type="text" class="text-center w-full border-gray-100" value="0" readonly></td>\
                                                                                        </tr>';

                fecha_inicio = moment(fecha_inicio).add(1, 'months');
            }

        }

        function check_paga_matricula(){
            paga_matricula = document.getElementById('paga_matricula').checked;
            h_matricula_cobrar = document.getElementById('h_matricula_cobrar');
            h_tipo_cobro = document.getElementById('h_tipo_cobro');
            if(paga_matricula == true){
                h_matricula_cobrar.style = 'display: block';
                h_tipo_cobro.style = 'display: block';
                document.getElementById('paga_matricula').value = 1;
            }else{
                h_matricula_cobrar.style = 'display: none';
                h_tipo_cobro.style = 'display: none';
                document.getElementById('paga_matricula').value = 0;
            }
        }

    </script>

</x-app-layout>
