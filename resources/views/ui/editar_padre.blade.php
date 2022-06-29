<div hidden id="editar_padre">

    <div class="bg-white rounded overflow-hidden shadow mb-4">

        <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

            <div class="mb-4">
                <label for="">Cedula</label>
                <input type="text" name="edit_cedula" id="edit_cedula" class="w-full rounded border-gray-400 enviar text-right" value="{{ number_format($alumno->padre->cedula, 0, ".", ".") }}"
                onkeyup="punto_decimal(this)" onchange="punto_decimal(this)">
                <input type="hidden" name="edit_id" id="edit_id" value="{{ $alumno->padre->id }}">
            </div>

            <div class="mb-4">
                <label for="">Nombre</label>
                <input type="text" name="edit_nombre" id="edit_nombre" class="w-full rounded border-gray-400 enviar text-left" value="{{ $alumno->padre->nombre }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Apellido</label>
                <input type="text" name="edit_apellido" id="edit_apellido" class="w-full rounded border-gray-400 enviar text-left" value="{{ $alumno->padre->apellido }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Telefono Particular</label>
                <input type="text" name="edit_telef_particular" id="edit_telef_particular" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->telefono_particular }}">
            </div>

            <div class="mb-4">
                <label for="">Telefono</label>
                <input type="text" name="edit_telefono" id="edit_telefono" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->telefono_wapp }}">
            </div>

            <div class="mb-4">
                <label for="">Direccion</label>
                <input type="text" name="edit_direccion" id="edit_direccion" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->direccion }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Lugar de Trabajo</label>
                <input type="text" name="edit_trabajo" id="edit_trabajo" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->lugar_trabajo }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Dias de Trabajo</label>
                <input type="text" name="edit_dias" id="edit_dias" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->horario_dias_trabajo }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Telefono Laboral</label>
                <input type="text" name="edit_telef_laboral" id="edit_telef_laboral" class="w-full rounded border-gray-400 enviar" value="{{ $alumno->padre->telefono_laboral }}">
            </div>
        </div>

    </div>

</div>
