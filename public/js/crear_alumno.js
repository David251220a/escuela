enviando = false; //Obligaremos a entrar el if en el primer submit
const foto_perfil = document.getElementById('foto_perfil');
foto_perfil.addEventListener('change', mostrarImagen, false);

function checkSubmit() {
    if (!enviando) {
        enviando= true;
        return true;
    } else {
        return false;
    }
}





var element = document.querySelectorAll('.enviar');
document.addEventListener('keydown', (event) => {
    const keyName = event.key;

    if (event.key == 'Enter') {
        event.preventDefault();
        if(event.target.id == 'cedula_madre'){
            cedula = document.getElementById('cedula_madre').value;
            if(cedula == 0){
                document.getElementById('id_madre').value = 1;
                document.getElementById('nombre_madre').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/madre_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_madre();
                    }else{
                        document.getElementById('id_madre').value = respuesta.data.id;
                        document.getElementById('nombre_madre').value = respuesta.data.nombre + ' '+ respuesta.data.apellido;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

        if(event.target.id == 'cedula_padre'){
            cedula = document.getElementById('cedula_padre').value;
            if(cedula == 0){
                document.getElementById('id_padre').value = 1;
                document.getElementById('nombre_padre').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/padre_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_padre();
                    }else{
                        document.getElementById('id_padre').value = respuesta.data.id;
                        document.getElementById('nombre_padre').value = respuesta.data.nombre + ' '+ respuesta.data.apellido;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

        if(event.target.id == 'cedula_encargado'){
            cedula = document.getElementById('cedula_encargado').value;
            if(cedula == 0){
                document.getElementById('id_encargado').value = 1;
                document.getElementById('nombre_encargado').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/encargado_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_encargado(1);
                    }else{
                        document.getElementById('id_encargado').value = respuesta.data.id;
                        document.getElementById('nombre_encargado').value = respuesta.data.nombre;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

        if(event.target.id == 'cedula_encargado1'){
            cedula = document.getElementById('cedula_encargado1').value;
            if(cedula == 0){
                document.getElementById('id_encargado1').value = 1;
                document.getElementById('nombre_encargado1').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/encargado_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_encargado(2);
                    }else{
                        document.getElementById('id_encargado1').value = respuesta.data.id;
                        document.getElementById('nombre_encargado1').value = respuesta.data.nombre;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

        if(event.target.id == 'cedula_encargado2'){
            cedula = document.getElementById('cedula_encargado2').value;
            if(cedula == 0){
                document.getElementById('id_encargado2').value = 1;
                document.getElementById('nombre_encargado2').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/encargado_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_encargado(3);
                    }else{
                        document.getElementById('id_encargado2').value = respuesta.data.id;
                        document.getElementById('nombre_encargado2').value = respuesta.data.nombre;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

        if(event.target.id == 'cedula_encargado3'){
            cedula = document.getElementById('cedula_encargado3').value;
            if(cedula == 0){
                document.getElementById('id_encargado3').value = 1;
                document.getElementById('nombre_encargado3').value = 'SIN ESPECIFICAR';
            }else{
                axios.post('/encargado_consulta',  {
                    cedula : cedula
                })
                .then(respuesta => {
                    if(JSON.stringify(respuesta.data)=='{}'){
                        crear_encargado(4);
                    }else{
                        document.getElementById('id_encargado3').value = respuesta.data.id;
                        document.getElementById('nombre_encargado3').value = respuesta.data.nombre;
                    }
                })
                .catch(error => {
                    console.log(error);

                })
            }

        }

    }

    if(event.key == 'F2'){
        id_aux = 0;
        if(event.target.id == 'lugar_nacimiento'){
            id_aux = 1;
            titulo = 'Agregar Lugar Nacimiento';
            select = document.getElementById('lugar_nacimiento');
        }

        if(event.target.id == 'alergia'){
            id_aux = 2;
            titulo = 'Agregar Alergia';
            select = document.getElementById('alergia');

        }

        if(event.target.id == 'seguro'){
            id_aux = 3;
            titulo = 'Agregar Seguro';
            select = document.getElementById('seguro');

        }

        if(event.target.id == 'enfermedad'){
            id_aux = 4;
            titulo = 'Agregar Enfermedad';
            select = document.getElementById('enfermedad');

        }
        var siguiente = document.getElementById('datos_formulario').innerHTML;
        if(parseInt(id_aux) == 0){

        }else{

            Swal.fire({
                title: titulo,
                html:
                siguiente,
                width: 600,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Guardar',

            }).then(resultado => {
                if (resultado.value) {
                    var nombre_aux = Swal.getPopup().querySelector('#nombre_tipo_aux').value;
                    axios.post('/crear_datos',  {
                        nombre_aux : nombre_aux,
                        id_aux : id_aux
                    })
                    .then(respuesta => {
                        for (let i = select.options.length; i >= 0; i--) {
                            select.remove(i);
                        }

                        for(var i=0; i < respuesta.data.length; i++){
                            var option = document.createElement('option');
                            var valor = respuesta.data[i].id;
                            var valor2 = respuesta.data[i].nombre;
                            option.value = valor;
                            option.text = valor2;
                            select.appendChild(option);
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })

                }

            })

        }

    }
});

function mostrarImagen(event) {
    var formData = new FormData();
    var imagefile = document.querySelector('#foto_perfil');
    formData.append("foto_perfil", imagefile.files[0]);

    var doc_v = event.target.files[0];

    var file = event.target.files[0];
    var reader = new FileReader();
    reader.onload = function(event) {
        var img = document.getElementById('avatar');
        img.src= event.target.result;
    }
    reader.readAsDataURL(file);

}


function cambio(){
    $('#foto_perfil').click();
}

// Formulario Modal para Agregar la Madre.
function crear_madre(){

    Swal.fire({
        title: 'Desea crear datos para la Madre?',
        text: "No existe coincidencia con este numero de cedula!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(resultado => {
        if (resultado.value) {
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
                                document.getElementById('id_madre').value = respuesta.data.id;
                                document.getElementById('cedula_madre').value = respuesta.data.cedula;
                                document.getElementById('nombre_madre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                                Swal.fire(
                                    'Datos de la Madre',
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
        })
}

//Formulario Modal para Agregar el Padre.
function crear_padre(){

    Swal.fire({
        title: 'Desea crear datos para el padre?',
        text: "No existe coincidencia con este numero de cedula!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(resultado => {
        if (resultado.value) {
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
        })
}

//Formulario Modal para Crear el Encargado.
function crear_encargado(encar){
    Swal.fire({
        title: 'Desea crear datos para el encargado?',
        text: "No existe coincidencia con este numero de cedula!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(resultado => {
        if (resultado.value) {
            var siguiente = document.getElementById('encargado_formulario').innerHTML;
            Swal.fire({
                title: '<u>Datos del Encargado</u>',
                html:
                siguiente,
                width: 800,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Guardar',

                }).then(resultado => {
                    if (resultado.value) {
                        var cedula_madre = Swal.getPopup().querySelector('#cedula_encargado_aux').value;
                        var nombre_madre = Swal.getPopup().querySelector('#encargado_nombre_aux').value;
                        var parentezo = Swal.getPopup().querySelector('#encargado_parentezco').value;
                        var telefono = Swal.getPopup().querySelector('#telefono_encargado_aux').value;
                        var observacion_encargado = Swal.getPopup().querySelector('#observacion_encargado').value;

                        axios.post('/encargado_crear',  {
                            cedula_madre : cedula_madre,
                            nombre_madre : nombre_madre,
                            parentezo : parentezo,
                            telefono : telefono,
                            observacion_encargado : observacion_encargado,
                        })
                        .then(respuesta => {
                            if(respuesta.data.ok == 1){

                                if(encar == 1){
                                    document.getElementById('id_encargado').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado').value = respuesta.data.nombre;
                                }

                                if(encar == 2){
                                    document.getElementById('id_encargado1').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado1').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado1').value = respuesta.data.nombre;
                                }

                                if(encar == 3){
                                    document.getElementById('id_encargado2').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado2').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado2').value = respuesta.data.nombre;
                                }

                                if(encar == 4){
                                    document.getElementById('id_encargado3').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado3').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado3').value = respuesta.data.nombre;
                                }

                                Swal.fire(
                                    'Datos del Encargado',
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
    })
}


//Donde coloca los puntos(Separador de miles) a las Variables Numericas.
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

//Donde se Colocan los textos en mayuscula
function mayuscula(input){
    input.value = input.value.toUpperCase();
}

//Donde se Crear el Padre
function ver_padre(){
    crear_padre();
}

//Donde se Crear la Madre
function ver_madre(){
    crear_madre();
}

//Donde se Crear el Encagado
function ver_encargado(encar){
    crear_encargado(encar);
}

//Para Cargar las Tablas Secundarias al darle Click en el Titulo.
function crear_opciones(input)
{
    id_aux = 0;
    if(input.id == 'lugar_nacimiento_crear_titulo'){
        id_aux = 1;
        titulo = 'Agregar Lugar Nacimiento';
        select = document.getElementById('lugar_nacimiento');
    }

    if(input.id == 'alergia_crear_titulo'){
        id_aux = 2;
        titulo = 'Agregar Alergia';
        select = document.getElementById('alergia');

    }

    if(input.id == 'seguro_crear_titulo'){
        id_aux = 3;
        titulo = 'Agregar Seguro';
        select = document.getElementById('seguro');

    }
    if(input.id == 'enfermedad_crear_titulo'){
        id_aux = 4;
        titulo = 'Agregar Enfermedad';
        select = document.getElementById('enfermedad');

    }
    var siguiente = document.getElementById('datos_formulario').innerHTML;
    if(parseInt(id_aux) == 0){

    }else{

        Swal.fire({
            title: titulo,
            html:
            siguiente,
            width: 600,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar',

        }).then(resultado => {
            if (resultado.value) {
                var nombre_aux = Swal.getPopup().querySelector('#nombre_tipo_aux').value;
                axios.post('/crear_datos',  {
                    nombre_aux : nombre_aux,
                    id_aux : id_aux
                })
                .then(respuesta => {
                    for (let i = select.options.length; i >= 0; i--) {
                        select.remove(i);
                    }

                    for(var i=0; i < respuesta.data.length; i++){
                        var option = document.createElement('option');
                        var valor = respuesta.data[i].id;
                        var valor2 = respuesta.data[i].nombre;
                        option.value = valor;
                        option.text = valor2;
                        select.appendChild(option);
                    }
                })
                .catch(error => {
                    console.log(error);
                })

            }

        })

    }
}

//Para cambiar el Valor del Check
function cambiar_check(input){

    if(input.checked == true){
        input.value = 1;
    }else{
        input.value = 0;
    }

}

function editar_padre(padres){
    if(padres == 1){
        var titulo = 'Editar Padre';
        var pregunta = 'Desea editar los datos del padre?';
        var titulo2 = 'Datos del Padre';
        var siguiente = document.getElementById('editar_padre').innerHTML;
    }else{
        var titulo = 'Editar Madre';
        var pregunta = 'Desea editar los datos de la madre?';
        var titulo2 = 'Datos de la Madre';
        var siguiente = document.getElementById('editar_madre').innerHTML;
    }
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
                        var id = padres;
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
                                // LO QUE MUESTRA
                                if(respuesta.data.padres == 1){
                                    document.getElementById('id_padre').value = respuesta.data.id;
                                    document.getElementById('cedula_padre').value = respuesta.data.cedula;
                                    document.getElementById('nombre_padre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                                }

                                if(respuesta.data.padres == 2){
                                    document.getElementById('id_madre').value = respuesta.data.id;
                                    document.getElementById('cedula_madre').value = respuesta.data.cedula;
                                    document.getElementById('nombre_madre').value = respuesta.data.nombre +' '+respuesta.data.apellido;
                                }

                                Swal.fire(
                                    titulo2,
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
    })
}

function editar_encargado(encargado){
    if(encargado == 1){
        var siguiente = document.getElementById('editar_encargado1').innerHTML;
    }
    if(encargado == 2){
        var siguiente = document.getElementById('editar_encargado2').innerHTML;
    }
    if(encargado == 3){
        var siguiente = document.getElementById('editar_encargado3').innerHTML;
    }
    if(encargado == 4){
        var siguiente = document.getElementById('editar_encargado4').innerHTML;
    }
    Swal.fire({
        title: 'Editar Datos del Encargado',
        text: "Desea editar datos del encargado?.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
    }).then(resultado => {
        if (resultado.value) {
            Swal.fire({
                title: '<u>Datos del Encargado</u>',
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

                                if(encargado == 1){
                                    document.getElementById('id_encargado').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado').value = respuesta.data.nombre;
                                }

                                if(encargado == 2){
                                    document.getElementById('id_encargado1').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado1').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado1').value = respuesta.data.nombre;
                                }

                                if(encargado == 3){
                                    document.getElementById('id_encargado2').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado2').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado2').value = respuesta.data.nombre;
                                }

                                if(encargado == 4){
                                    document.getElementById('id_encargado3').value = respuesta.data.id;
                                    document.getElementById('cedula_encargado3').value = respuesta.data.cedula;
                                    document.getElementById('nombre_encargado3').value = respuesta.data.nombre;
                                }

                                Swal.fire(
                                    'Datos del Encargado',
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
    })
}
