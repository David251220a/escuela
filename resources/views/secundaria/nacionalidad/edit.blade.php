<x-app-layout>
    {{-- para hacer una prueba --}}
<h2 class="text-gray-600 font-semibold text-xl mb-6" >EDITAR NACIONALIDAD  :      {{$nacionalidad->nombre}}</h2>

    {{-- todo lo que esta ak adentro va a el controlador update --}}
    <form action="{{route('nacionalidad.update', $nacionalidad)}}" method="POST">
       @method('PUT')
       @csrf

      <div name="Datos_de_la_tabla_Nacionalidad">
       {{-- El Mb-4 es el espacio entre los campos --}}
       <div class="mb-4">
           <label for="" class="text-gray-500 mb-1 text-lg" >Nombre</label>
           <input type="text" class="block w-full border-gray-300 py-2 text-xl rounded" name="nombre" value = "{{$nacionalidad->nombre}}" >
       </div>

       {{-- El Mb-4 es el espacio entre los campos --}}
       <div class="mb-4">
           <label for="" class="text-gray-500 mb-1 text-lg" >Estado</label>
           <select name="estado_id" id="estado_id" class="block w-full border-gray-300 py-2 text-xl rounded">
               <option {{($nacionalidad->estado_id==2 ? 'selected' :'')}} value="2">Inactivo</option>
               <option {{($nacionalidad->estado_id==1 ? 'selected' :'')}} value="1">Activo</option>
           </select>
       </div>
     </div>

     <div name="Botones">
       <button type="submit" class="bg-blue-500 text-white mr-2 py-2 px-6 text-lg font-bold rounded">
           Actualizar
       </button>
       <a href="javascript:history.back()" class="px-4 py-3 bg-red-600 text-white font-bold rounded">Volver</a>
   </form>

</x-app-layout>
