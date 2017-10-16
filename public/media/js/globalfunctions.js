// JavaScript Document
$(document).ready(function(){
	jQuery.extend(jQuery.validator.messages, {
		required: 'Este campo es obligatorio.',
		textOnly: 'Este campo admite s&oacute;lo texto.',
		alphaNumeric: 'Este campo admite s&oacute;lo caracteres alfa - num&eacute;ricos.',
		date: 'Este campo tiene un formato dd/mm/YYYY.',
        dateISO: 'Este campo tiene un formato YYYY-mm-dd.',
		digits: 'Este campo admite solo d&iacute;gitos.',
		number: 'Este campo admite solo n&uacute;meros enteros o decimales.',
		alphaNumericSpecial: 'Este campo admite s&oacute;lo caracteres alfa - num&eacute;ricos.',
		email: 'Este campo admite el formato <i>direccion@dominio.com</i>.',
		url: "Ingrese un URL v&aacute;lido.",
		numberDE: "Bitte geben Sie eine Nummer ein.",
		percentage: "Este campo debe tener un porcentaje v&aacute;lido.",
		validarUserName: "Nombre de Usuario no v\u00E1lido.",
		creditcard: "Ingrese un n&uacute;mero de tarjeta de cr&eacute;dito v&aacute;lido.",
		equalTo: "Las direcciones de correo no coinciden.",
		notEqualTo: "Ingrese un valor diferente.",
		accept: "Ingrese un valor con una extensi&oacute;n v&aacute;lida.",
		maxlength: $.validator.format("Este campo debe tener m&aacute;ximo {0} caracteres."),
		minlength: $.validator.format("Este campo debe tener m&iacute;nimo {0} caracteres."),
		rangelength: $.validator.format("Ingrese un valor entre {0} y {1} caracteres."),
		range: $.validator.format("Ingrese un valor entre {0} y {1}."),
		max: $.validator.format("Ingrese un valor menor o igual a {0}."),
		min: $.validator.format("Ingrese un valor mayor o igual a {0}."),
		cedulaEcuador: "Por favor ingrese una c&eacute;dula v&aacute;lida.",
		dateLessThan: $.validator.format("Ingrese una fecha menor o igual a {0}."),
		dateMoreThan: $.validator.format("Ingrese una fecha mayor o igual a {0}."),
        minStrict_zero:'El valor debe ser mayor o igual a cero',
        minStrict:'Ingrese un valor mayor a cero',
        dateLessThanDate:'La fecha "Desde" debe ser menor o igual a la fecha en el campo "Hasta".'
	});

    jQuery.validator.addMethod("georeference", function(value, element)
    {
        return this.optional(element) || /^(\-?\d+(\.\d+)?),(\-?\d+(\.\d+)?)$/i.test(value);
    }, "Por favor ingrese una georeferencia v&aacute;lida");

    jQuery.validator.addMethod("lettersonly", function(value, element)
    {
        return this.optional(element) || /^[a-z," "ñáéíóúÑÁÉÍÓÚ]+$/i.test(value);
    }, "Por favor ingrese solamente letras");

    jQuery.validator.addMethod("notEqualTo", function(value, element, param) {
        return this.optional(element) || value != $(param).val();
    }, "Este campo debe ser diferente");

    jQuery.validator.addMethod("noSpace", function(value, element) {
        return value.indexOf(" ") < 0 ;
    }, "Este campo no admite espacios en blanco.");

    jQuery.validator.addMethod("notEqualTechnician", function() {
        var matchFound = 0;
        var valueToCompare = $('#technician_id').val();
        $('#accompanying_technician > option:selected').each(function() {
            if($(this).val() == valueToCompare){
                matchFound = 1;
            }
        });
        return matchFound != 1;
    }, "El acompañante no puede ser el mismo que el técnico responsable");

    jQuery.validator.addMethod("cedulaEcuador", function(value, element) {
        var texto = value;
        if(texto != ''){
            if(texto.charAt(9)!='' && texto.charAt(10)==''){
                var digitos=new Array(parseInt(texto.charAt(0)),parseInt(texto.charAt(1)),parseInt(texto.charAt(2)),parseInt(texto.charAt(3)),parseInt(texto.charAt(4)),parseInt(texto.charAt(5)),parseInt(texto.charAt(6)),parseInt(texto.charAt(7)),parseInt(texto.charAt(8)),parseInt(texto.charAt(9)));
                var aux;
                var suma=0;

                for(i=0; i<9; i++){
                    if(i%2 == 0){
                        aux=digitos[i]*2;
                        if(aux>=10)
                            suma+=aux-9;
                        else
                            suma+=aux;
                    }else
                        suma+=digitos[i];
                }

                if(suma < 10)
                {
                    var unidad=parseInt(String(suma).charAt(0));
                    var decena=0;
                }else
                {
                    var unidad=parseInt(String(suma).charAt(1));
                    var decena=parseInt(String(suma).charAt(0));
                }

                if(unidad==0){
                    if(texto.charAt(9)=='0')
                        return true;
                    else
                        return false;
                }else{
                    var comprobador=(decena+1)*10;
                    if(comprobador-suma==digitos[9])
                        return true;
                    else
                        return false;
                }
            }else
                return false;
        }else{
            return true;
        }
    }, "Ingrese una cédula válida");

    jQuery.validator.addMethod('minStrict', function (value, el, param) {
        if (value!=''){
            return value > param;
        }else{
            return true;
        }

    });

    jQuery.validator.addMethod("time", function(value, element) {
        return this.optional(element) || /^(([0-1]?[0-9])|([2][0-3])):([0-5]?[0-9])(:([0-5]?[0-9]))?$/i.test(value);
    }, "Ingrese un formato de hora válido (Horas:minutos).");

jQuery.validator.addMethod("plate", function(value, element) {
        return this.optional(element) || /^[A-Z]{2,3}-[0-9]{4}$/i.test(value);
    }, "Ingrese una placa válida.");


    jQuery.validator.addMethod("notEqualToGroup", function(value, element, options) {
        // Get all elements send to the form with the same class.
        var elems = $(element).parents('form').find(options[0]);
       // The current element value.
        var valueToCompare = value;
       // counter
        var matchesFound = 0;
       // Search each element and compare her value with the value of the current element
       // and increase the counter every time that find a repeated value.
        jQuery.each(elems, function() {
            thisVal = $(this).val();
            if (thisVal == valueToCompare) {
                matchesFound++;
            }
        });
        //console.log(matchesFound);
       // the counter can be 0 o 1 o mayor
        if (this.optional(element) || matchesFound <= 1) {
       //            elems.removeClass('error');
            return true;
        } else {
       //            elems.addClass('error');
            return false;
        }
    }, jQuery.format("Ya se ha seleccionado esta categor&iacute;a o elemento"));

    jQuery.validator.addMethod("decimals", function(value, element) {
        return this.optional(element) || /^\d{0,16}(\.\d{0,2})?$/i.test(value);
    }, "Por favor incluya m&aacute;ximo 2 decimales");

    jQuery.validator.addMethod("negativeDecimals", function(value, element) {
        return this.optional(element) || /^[+-]?\d{0,16}(\.\d{0,2})?$/i.test(value);
    }, "Por favor incluya m&aacute;ximo 2 decimales");

    jQuery.validator.addMethod("textOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z\u00C1\u00E1\u00C9\u00E9\u00CD\u00ED\u00D3\u00F3\u00DA\u00FA\u00DC\u00FC\u00D1\u00F1 ]+$/.test(value);
    });

    jQuery.validator.addMethod("fourDecimals", function(value, element) {
        return this.optional(element) || /^\d{0,16}(\.\d{0,4})?$/i.test(value);
    }, "Por favor incluya m&aacute;ximo 4 decimales");
});

function show_ajax_loader(){
    $("#container_loader").css('display','block');
    $("#loader").css('display','block');
}

function hide_ajax_loader(){
    $("#container_loader").css('display','none');
    $("#loader").css('display','none');
}


/*
 * this swallows backspace keys on any non-input element.
 * stops backspace -> back
 */
var rx = /INPUT|SELECT|TEXTAREA/i;

$(document).bind("keydown keypress", function(e){
    if( e.which == 8 ){ // 8 == backspace
        if(!rx.test(e.target.tagName) || e.target.disabled || e.target.readOnly ){
            e.preventDefault();
        }
    }
});

function addCommas(nStr)
{
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

function parseDateFormat(str) {
    var mdy = str.split('-')
    return new Date(mdy[0], mdy[1]-1, mdy[2]);
}





