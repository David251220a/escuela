<div hidden id="editar_encargado1">

    <div class="bg-white rounded overflow-hidden shadow mb-4">

        <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

            <div class="mb-4">
                <label for="">Cedula</label>
                <input type="text" name="edit_cedula_en" id="edit_cedula_en" class="w-full rounded border-gray-400 text-right enviar" value="{{ number_format($cedula, 0, ".", ".") }}"
                onkeyup="punto_decimal(this)" onchange="punto_decimal(this)">
                <input type="hidden" name="edit_id" id="edit_id" value="{{ $encargado_id }}">
            </div>

            <div class="mb-4">
                <label for="">Nombre</label>
                <input type="text" name="edit_nombre_en" id="edit_nombre_en" class="w-full rounded border-gray-400 enviar" value="{{ $nombre }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Parentezco</label>
                <select name="endit_parentezco_en" id="endit_parentezco_en" class="w-full rounded border-gray-400 enviar">
                    <option {{ ($parentezco == 'SIN ESPECIFICAR' ? 'selected' : '') }} value="SIN ESPECIFICAR">SIN ESPECIFICAR</option>
                    <option {{ ($parentezco == 'HERMANO/A' ? 'selected' : '') }} value="HERMANO/A">HERMANO/A</option>
                    <option {{ ($parentezco == 'TIO/A' ? 'selected' : '') }} value="TIO/A">TIO/A</option>
                    <option {{ ($parentezco == 'ABUELO/A' ? 'selected' : '') }} value="ABUELO/A">ABUELO/A</option>
                    <option {{ ($parentezco == 'PADRASTRO' ? 'selected' : '') }} value="PADRASTRO">PADRASTRO</option>
                    <option {{ ($parentezco == 'MADRASTRA' ? 'selected' : '') }} value="MADRASTRA">MADRASTRA</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="">Telefono</label>
                <input type="text" name="edit_telef_en" id="edit_telef_en" class="w-full rounded border-gray-400 enviar" value="{{ $telefono}}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="col-span-2 mb-4">
                <label for="">Observacion</label>
                <input type="text" name="edit_observacion_en" id="edit_observacion_en" class="w-full rounded border-gray-400 enviar" value="{{ $observacion }}"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

        </div>

    </div>

</div>
