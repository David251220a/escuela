<div hidden id="encargado_formulario">

    <div class="bg-white rounded overflow-hidden shadow mb-4">

        <div class="md:grid grid-cols-2 gap-4 px-4 py-6">

            <div class="mb-4">
                <label for="">Cedula</label>
                <input type="text" name="cedula_encargado_aux" id="cedula_encargado_aux" class="w-full rounded border-gray-400 text-right enviar"
                onkeyup="punto_decimal(this)" onchange="punto_decimal(this)">
            </div>

            <div class="mb-4">
                <label for="">Nombre</label>
                <input type="text" name="encargado_nombre_aux" id="encargado_nombre_aux" class="w-full rounded border-gray-400 enviar"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="mb-4">
                <label for="">Parentezco</label>
                <select name="encargado_parentezco" id="encargado_parentezco" class="w-full rounded border-gray-400 enviar">
                    <option value="SIN ESPECIFICAR">SIN ESPECIFICAR</option>
                    <option value="HERMANO/A">HERMANO/A</option>
                    <option value="TIO/A">TIO/A</option>
                    <option value="ABUELO/A">ABUELO/A</option>
                    <option value="PADRASTRO">PADRASTRO</option>
                    <option value="MADRASTRA">MADRASTRA</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="">Telefono</label>
                <input type="text" name="telefono_encargado_aux" id="telefono_encargado_aux" class="w-full rounded border-gray-400 enviar"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

            <div class="col-span-2 mb-4">
                <label for="">Observacion</label>
                <input type="text" name="observacion_encargado" id="observacion_encargado" class="w-full rounded border-gray-400 enviar"
                onkeyup="mayuscula(this)" onchange="mayuscula(this)">
            </div>

        </div>

    </div>

</div>
