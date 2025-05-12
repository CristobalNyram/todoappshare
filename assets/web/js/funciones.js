//$(document).ready(function() 
//{  
    var formatNumber = {
        separador: ",", // separador para los miles
        sepDecimal: '.', // separador para los decimales
        formatear: function (num) 
        {
            num += '';
            var splitStr = num.split('.');
            var splitLeft = splitStr[0];
            var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
            var regx = /(\d+)(\d{3})/;
            while (regx.test(splitLeft)) {
                splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
            }
            return this.simbol + splitLeft + splitRight;
        },
        new: function (num, simbol) {
            this.simbol = simbol || '';
            return this.formatear(num);
        }
    }


    function alertaUI( texto ) 
    {
        $.blockUI({   
            css: 
            {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            },
            message: '<h1><img src="../images/loading.gif" /> </h1> '+texto 
        });
    }

    function alertaUIFin() 
    {
        $.unblockUI(); 
    }
    
    
    function tieneEspaciosCadena(cadena)
    {
        var resultado   =   false;
        var logitud     =   cadena.length;
        for ( var k = 0;  k < logitud;  k = k +1 )
        {
            var c   = cadena.charAt(k);
            if( c != ' ' )
            {
                resultado = true;
            }
        }
        return resultado;
    }

    function getValueItem (itemCadena)
    {
        var dato        =   itemCadena.split(':');
        var value       =   null;
        if( dato.length > 1 ) 
        {
            value           =  dato[1];            
            value           =  value.replace('"','');       
            value           =  value.replace('"','');
        }
        return value;
    }

//});