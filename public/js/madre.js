function crear_madre(){

    var siguiente = document.getElementById('madre_formulario').innerHTML;
    Swal.fire({
        title: '<u>Datos de la Madre</u>',
        html:
        siguiente,
        width: 800,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Guardar',

        }).then(resultado => {
            if (resultado.value) {
                var cedula_madre = Swal.getPopup().querySelector('#cedula_madre_aux').value;
                var nombre_madre = Swal.getPopup().querySelector('#nombre_madre_aux').value;
                var apellido_madre = Swal.getPopup().querySelector('#apellido_madre_aux').value;
                var telefono_particular = Swal.getPopup().querySelector('#telefono_particular_madre_aux').value;
                var telefono = Swal.getPopup().querySelector('#telefono_madre_aux').value;
                var direccion = Swal.getPopup().querySelector('#direccion_madre_aux').value;
                var lugar_trabajo = Swal.getPopup().querySelector('#trabajo_madre_aux').value;
                var dias_trabajo = Swal.getPopup().querySelector('#dias_trabajo_madre_aux').value;
                var telefono_trabajo = Swal.getPopup().querySelector('#telefono_trabajo_madre_aux').value;

                axios.post('/madre_crear',  {
                    cedula_madre : cedula_madre,
                    nombre_madre : nombre_madre,
                    apellido_madre : apellido_madre,
                    telefono_particular : telefono_particular,
                    telefono : telefono,
                    direccion : direccion,
                    lugar_trabajo : lugar_trabajo,
                    dias_trabajo : dias_trabajo,
                    telefono_trabajo : telefono_trabajo,
                })
                .then(respuesta => {
                    if(respuesta.data.ok == 1){
                        Swal.fire(
                            'Datos de la Madre',
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

function punto_decimal(input){
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        if(num == ''){

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

function mayuscula(input){
    input.value = input.value.toUpperCase();
}

function todos(padre_id){

    llamar_livewire(padre_id);
}

// function editar_padre(padres){

//     if(padres == 1){
//         var titulo = 'Editar Padre';
//         var pregunta = 'Desea editar los datos del padre?';
//         var titulo2 = 'Datos del Padre';
//         var siguiente = document.getElementById('editar_padre').innerHTML;
//     }else{
//         var titulo = 'Editar Madre';
//         var pregunta = 'Desea editar los datos de la madre?';
//         var titulo2 = 'Datos de la Madre';
//         var siguiente = document.getElementById('editar_madre').innerHTML;
//     }

//     Swal.fire({
//         title: titulo,
//         text: pregunta,
//         icon: 'warning',
//         showCancelButton: true,
//         confirmButtonColor: '#3085d6',
//         cancelButtonColor: '#d33',
//         confirmButtonText: 'Si'
//     }).then(resultado => {
//         if (resultado.value) {
//             Swal.fire({
//                 title: '<u>'+ titulo2+'</u>',
//                 html:
//                 siguiente,
//                 width: 800,
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText: 'Guardar',

//                 }).then(resultado => {
//                     if (resultado.value) {
//                         var id = padres;
//                         var edit_id = Swal.getPopup().querySelector('#edit_id').value;
//                         var edit_cedula = Swal.getPopup().querySelector('#edit_cedula').value;
//                         var edit_nombre = Swal.getPopup().querySelector('#edit_nombre').value;
//                         var edit_apellido = Swal.getPopup().querySelector('#edit_apellido').value;
//                         var edit_telef_particular = Swal.getPopup().querySelector('#edit_telef_particular').value;
//                         var edit_telefono = Swal.getPopup().querySelector('#edit_telefono').value;
//                         var edit_direccion = Swal.getPopup().querySelector('#edit_direccion').value;
//                         var edit_trabajo = Swal.getPopup().querySelector('#edit_trabajo').value;
//                         var edit_dias = Swal.getPopup().querySelector('#edit_dias').value;
//                         var edit_telef_laboral = Swal.getPopup().querySelector('#edit_telef_laboral').value;

//                         axios.post('/editar_padres',  {
//                             id : id,
//                             edit_id : edit_id,
//                             edit_cedula : edit_cedula,
//                             edit_nombre : edit_nombre,
//                             edit_apellido : edit_apellido,
//                             edit_telef_particular : edit_telef_particular,
//                             edit_telefono : edit_telefono,
//                             edit_direccion : edit_direccion,
//                             edit_dias : edit_dias,
//                             edit_trabajo : edit_trabajo,
//                             edit_telef_laboral : edit_telef_laboral,
//                         })
//                         .then(respuesta => {
//                             if(respuesta.data.ok == 1){
//                                 Swal.fire(
//                                     titulo2,
//                                     respuesta.data.mensaje,
//                                     'success'
//                                 )
//                             }else{
//                                 Swal.fire({
//                                     icon: 'error',
//                                     title: 'Oops...',
//                                     text: respuesta.data.mensaje,
//                                 })
//                             }

//                         })
//                         .catch(error => {
//                             console.log(error);
//                         })
//                     }

//             })
//         }
//     })
// }

function llamar_livewire(padre_id){
    Livewire.emit('editar', padre_id);
}


function crear_padre(){
    var siguiente = document.getElementById('padre_formulario').innerHTML;
    Swal.fire({
        title: '<u>Datos del Padre</u>',
        html:
        siguiente,
        width: 800,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Guardar',

        }).then(resultado => {
            if (resultado.value) {
                var cedula_madre = Swal.getPopup().querySelector('#cedula_padre_aux').value;
                var nombre_madre = Swal.getPopup().querySelector('#nombre_padre_aux').value;
                var apellido_madre = Swal.getPopup().querySelector('#apellido_padre_aux').value;
                var telefono_particular = Swal.getPopup().querySelector('#telefono_particular_padre_aux').value;
                var telefono = Swal.getPopup().querySelector('#telefono_padre_aux').value;
                var direccion = Swal.getPopup().querySelector('#direccion_padre_aux').value;
                var lugar_trabajo = Swal.getPopup().querySelector('#trabajo_padre_aux').value;
                var dias_trabajo = Swal.getPopup().querySelector('#dias_trabajo_padre_aux').value;
                var telefono_trabajo = Swal.getPopup().querySelector('#telefono_trabajo_padre_aux').value;

                axios.post('/padre_crear',  {
                    cedula_madre : cedula_madre,
                    nombre_madre : nombre_madre,
                    apellido_madre : apellido_madre,
                    telefono_particular : telefono_particular,
                    telefono : telefono,
                    direccion : direccion,
                    lugar_trabajo : lugar_trabajo,
                    dias_trabajo : dias_trabajo,
                    telefono_trabajo : telefono_trabajo,
                })
                .then(respuesta => {
                    if(respuesta.data.ok == 1){
                        document.getElementById('id_padre').value = respuesta.data.id;
                        document.getElementById('cedula_padre').value = respuesta.data.cedula;
                        document.getElementById('nombre_padre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                        Swal.fire(
                            'Datos del Padre',
                            respuesta.data.mensaje,
                            'success'
                        )
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
