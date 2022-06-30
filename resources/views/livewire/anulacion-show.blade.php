<div>

    <input type="hidden" wirwire:model="alumno_id" name="alumno_id" id="alumno_id" value="{{ $alumno_id }}">

    <div class="md:grid grid-cols-4 px-4">
        <div class="mb-4">
            <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
                border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                duration-200 mt-0 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
            <x-jet-label class="">Por Numero de Recibo</x-jet-labe>
            <x-jet-input value="aa" class="border border-gray-300 py-2"></x-jet-input>
        </div>

        <div class="mb-4">
            <input class="form-check-input form-check-input appearance-none rounded-full h-4 w-4 border
                border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition
                duration-200 mt-0 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1">
            <x-jet-label class="">Por Fecha</x-jet-labe>
            <x-jet-input type="date" class="border border-gray-300 py-2 mb-2"></x-jet-input>
            <x-jet-input type="date" class="border border-gray-300 py-2"></x-jet-input>
        </div>
        <div class="mb-4">
            <x-jet-label class="">Tipo de Ingreso</x-jet-labe>
            <select name="" id="" class="w-full text-gray-700 border border-gray-300 rounded">
                <option value="0">Todos</option>
            </select>
        </div>
    </div>


</div>
