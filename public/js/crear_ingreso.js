enviando = false; //Obligaremos a entrar el if en el primer submit
var contador = 0;
var total = 0;
var total_cantidad = 0;

function checkSubmit() {
    if (!enviando) {
        enviando= true;
        return true;
    } else {
        return false;
    }
}

function format(input){
    var num = input.value.replace(/\./g,'');
    if(!isNaN(num)){
        if((num == '') || (num == 0)){

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

function anadir_ingreso(){
    var index = 0;
    var precio = 0;
    var id_ingreso = 0;
    var cantidad = 0;

    html_concepto = document.getElementById('ingreso_concepto');
    html_precio = document.getElementById('precio');
    html_cantidad = document.getElementById('cantidad');

    index = html_concepto.selectedIndex;
    precio = html_precio.value.replace(/\./g,'');
    id_ingreso = html_concepto.options[index].value;
    text_concepto = html_concepto.options[index].text;
    cantidad = html_cantidad.value;
    contador = contador + 1;
    total_ingreso = parseInt(precio.replace(/\./g,'')) * parseInt(cantidad.replace(/\./g,''));
    total = total + total_ingreso;
    total_cantidad = parseInt(total_cantidad) + parseInt(cantidad);
    total_ingreso = total_ingreso.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    total_ingreso = total_ingreso.split('').reverse().join('').replace(/^[\.]/,'');
    precio = precio.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    precio = precio.split('').reverse().join('').replace(/^[\.]/,'');
    document.getElementById("ingresos").insertRow(-1).innerHTML =
    '<tr>\
        <td class"text-center w-full" style="text-align: center">'+text_concepto+'<input type="hidden" name="id_concepto[]" value="'+id_ingreso+'"\
        </td>\
        <td class"text-right">\
        <input type="text" class="text-right w-full border-gray-100" name="precio['+contador+']" value="'+precio+'" readonly><input type="hidden" name="precio_aux[]" value="'+precio+'" readonly>\
        </td>\
        <td class"text-right">\
        <input type="text" class="text-right w-full border-gray-100" name="cantidad['+contador+']" id="cantidad['+contador+']" value="'+cantidad+'" readonly><input type="hidden"name="cantidad_aux[]" value="'+cantidad+'" readonly>\
        </td>\
        <td class"text-right">\
        <input type="text" class="text-right w-full border-gray-100" name="total_ingreso['+contador+']" id="total_ingreso['+contador+']" value="'+total_ingreso+'" readonly><input type="hidden" name="total_ingreso_aux[]" value="'+total_ingreso+'" readonly>\
        </td>\
        <td class"text-center"> <button type="button" id="'+contador+'" class="mx-4" onclick="quitar_concepto(this)"> <i class="bx bxs-x-circle"></i> </button> </td>\
    </tr>';

    html_cantidad.value = 1;
    aux_total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    aux_total = aux_total.split('').reverse().join('').replace(/^[\.]/,'');
    document.getElementById('total_ingresoss').value = aux_total;
    document.getElementById('total_pagar').value = aux_total;
    document.getElementById('total_pagar_completo').value = aux_total;
    document.getElementById('cantidad_total').value = total_cantidad;
}

function quitar_concepto(btn_quitar){
    var resta = document.getElementById('total_ingreso['+btn_quitar.id+']').value;
    var resta_cant= document.getElementById('cantidad['+btn_quitar.id+']').value;
    total = total - parseInt(resta.replace(/\./g,''));
    total_cantidad = total_cantidad - parseInt(resta_cant);
    aux_total = total.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    aux_total = aux_total.split('').reverse().join('').replace(/^[\.]/,'');
    document.getElementById('total_ingresoss').value = aux_total;
    document.getElementById('cantidad_total').value = total_cantidad;
    document.getElementById('total_pagar').value = aux_total;
    document.getElementById('total_pagar_completo').value = aux_total;

    var rowIndex = btn_quitar.parentNode.parentNode.parentNode.rowIndex;
    document.getElementById("ingresos").deleteRow(rowIndex);
}

function cambiar_precio(){
    var index = 0;
    var precio = 0;
    html_concepto = document.getElementById('ingreso_concepto');
    html_precio = document.getElementById('ingreso_concepto_precio');
    index = html_concepto.selectedIndex;
    precio = html_precio.options[index].value;
    precio = precio.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
    precio = precio.split('').reverse().join('').replace(/^[\.]/,'');
    document.getElementById('precio').value = precio;
}

function mayuscula(input){
    input.value = input.value.toUpperCase();
}

document.addEventListener('keydown', (event) => {
    const keyName = event.key;

    if(event.key == 'F2'){
        var siguiente = document.getElementById('conceptos').innerHTML;
        Swal.fire({
            title: 'Nuevo Concepto Ingreso',
            html:
            siguiente,
            width: 600,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar',

        }).then(resultado => {

            if (resultado.value) {
                select = document.getElementById('ingreso_concepto');
                select_precio = document.getElementById('ingreso_concepto_precio');
                var nombre = Swal.getPopup().querySelector('#nombre').value;
                var precio = Swal.getPopup().querySelector('#precio').value;
                var unico = Swal.getPopup().querySelector('#unico').value;
                axios.post('/crear_ingreso',  {
                    nombre : nombre,
                    precio : precio,
                    unico : unico,
                })
                .then(respuesta => {
                    for (let i = select.options.length; i >= 0; i--) {
                        select.remove(i);
                    }
                    for (let i = select_precio.options.length; i >= 0; i--) {
                        select_precio.remove(i);
                    }

                    for(var i=0; i < respuesta.data.length; i++){
                        var option = document.createElement('option');
                        var option2 = document.createElement('option');
                        var valor = respuesta.data[i].id;
                        var valor2 = respuesta.data[i].nombre;
                        var valor3 = respuesta.data[i].precio;
                        option.value = valor;
                        option.text = valor2;
                        select.appendChild(option);
                        option2.value = valor3;
                        option2.text = valor3;
                        select_precio.appendChild(option2);
                    }

                })
                .catch(error => {
                    console.log(error);
                    console.log(error.response.data);
                })

            }

        })
    }
});

