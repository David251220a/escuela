enviando = false; //Obligaremos a entrar el if en el primer submit

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

        return;
    }

    if(nombre_alumno == 'SIN ESPECIFICAR'){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe elegir un alumno para poder generar cuota.',
        })
        return;
    }

    if(turno_id == 1){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debe elegir un turno para poder generar cuota.',
        })
        return false;
    }

    if((monto_cuota == 0) || (monto_cuota == '')) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'El monto cuota debe ser mayor a 0 para poder generar cuota.',
        })
        return false;
    }
    fecha_inicio = moment(fecha_inicio);
    var now = moment();
    if(fecha_inicio.year() != now.year()){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La año de la fecha de inicio deberia ser de este año.',
        })
        return false;
    }

    if(cantidad_cuota <= 0){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'La cantidad de cuota no puede ser menor o igual a 0!!.',
        })

        return false;
    }
    var cont = 0;
    for (let i = 0; i < cantidad_cuota; i++) {

        lastmonthlastdate = moment(fecha_inicio).startOf('month').add(4, 'days').format('DD-MM-YYYY');
        cont++;
        document.getElementById("generacion_cuota_body").insertRow(-1).innerHTML = '<tr>\
                                                                                    <td class"text-center"><input type="text" class="text-center w-full border-gray-100" name="cant_cuota[]" value="'+cont+'" readonly> </td>\
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

