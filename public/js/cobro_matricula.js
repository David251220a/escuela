var cant_cuotas = 0;
var const_total = 0;

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

    if(input.name == 'multa'){
        recalcular();
    }
}

function cal_total_pagar(input){

    paga_matricula = input.checked;
    index = input.id;
    multa = parseInt(document.getElementById('multa').value.replace(/\./g,''));
    cobrar = parseInt(document.getElementById('cuota_cobrar[' +index+']').value);
    saldo = parseInt(document.getElementById('cuota_saldo[' +index+']').value.replace(/\./g,''));
    total_cobrar = parseInt(document.getElementById('total_cobrar').value.replace(/\./g,''));
    if(const_total > 0){
        total_cobrar = const_total;
    }

    if(paga_matricula == true){
        input.value = 1;
        total_cobrar = total_cobrar + (cobrar - saldo);
        const_total = total_cobrar;
        total_cobrar = total_cobrar.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        total_cobrar = total_cobrar.split('').reverse().join('').replace(/^[\.]/,'');
        document.getElementById('total_cobrar').value = total_cobrar;
        cant_cuotas = cant_cuotas + 1;
    }else{
        input.value = 0;
        total_cobrar = total_cobrar - (cobrar - saldo);
        const_total = total_cobrar;
        total_cobrar = total_cobrar.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
        total_cobrar = total_cobrar.split('').reverse().join('').replace(/^[\.]/,'');
        document.getElementById('total_cobrar').value = total_cobrar;
        cant_cuotas = cant_cuotas - 1;
    }

    if(multa > 0){
        recalcular();
    }


}

function recalcular(){

    multa = parseInt(document.getElementById('multa').value.replace(/\./g,''));
    multa_total_cobrar = 0;
    total_cobrar = 0;
    if(cant_cuotas > 0){

        multa_total_cobrar = multa * cant_cuotas;

    }else{
        multa_total_cobrar = 0
        document.getElementById('total_cobrar').value = 0;
    }

    total_cobrar = const_total + multa_total_cobrar;
    document.getElementById('total_cobrar').value = total_cobrar
    console.log(cant_cuotas, multa_total_cobrar);
}
