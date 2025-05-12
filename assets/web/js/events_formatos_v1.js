$(document).ready(function() 
{  
    $( ".hora-minutos" ).keydown(function(e) 
    {	
    	var dato = $(this).val();  	
    	// 96 =0 , 97= 1 ,98= 2 ,99=3 ,100=4 ,101=5 																			//48 = 0, 49=1, 50=2, 51=3, 52=4, 53=5
      	
      	//alert(dato.length+"   "+e.which);
      	if (dato.length == 0 && ((e.which>=96  && e.which<=101) ||  e.which== 9 ||  e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39 ||  (e.which>=48  && e.which<=53) )  )
      	{
      	} 
      	else if (dato.length != 0 && ((e.which>=96  && e.which<=105) ||  e.which== 9 ||  e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39 || e.which== 110 || e.which== 190 || (e.which>=48  && e.which<=57) ) )
      	{
      	}
      	else 
      	{	
      		e.preventDefault();     
      	}
    });


    $( ".onlyNumericsPunt" ).keydown(function(e)   //  12:00
    {	
    	var dato = $(this).val();
    	if( contarPuntos (dato, '.') > 0  &&  (e.which == 110 || e.which == 190)  ) // . 
    	{
    		e.preventDefault();  // detiene el evento
    	}
    																									                      // punto  = 110 or 190				
      	if ((e.which>=96  && e.which<=105) ||  e.which== 9 ||  e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39 || e.which== 110 || e.which== 190 || (e.which>=48  && e.which<=57) ) {
      	} else {		e.preventDefault();     }  
    });


    $( ".onlyFecha" ).keydown(function(e)   
    { 
        var dato = $(this).val();
        $(this).val(limpiarCadena(dato));
    });


    $( ".onlyNumerics" ).keydown(function(e) 
    {
      	if ((e.which>=96  && e.which<=105) ||  e.which== 9 ||  e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39 || (e.which>=48  && e.which<=57) ) {
      	} else {		e.preventDefault();     }  
    });

    $( ".onlyLetters" ).keydown(function(e) 
    {

    	//       rango de letras               tabulador       regreso        suprimir        fecha izq       flecha der        espacio            ñ    
    	if ((e.which>=65  && e.which<=90) ||  e.which== 9 || e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39  || e.which== 32   || e.which== 192 ) {
      	} else { e.preventDefault(); 	}  
    });


    $( ".onlyLetters-asterisco" ).keydown(function(e) 
    {

        //alert(e.which);
        //       rango de letras               tabulador       regreso        suprimir        fecha izq       flecha der        espacio            ñ                   *
        if ((e.which>=65  && e.which<=90) ||  e.which== 9 || e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39  || e.which== 32   || e.which== 192   || e.which== 106  || e.which== 16 || e.which== 171  ) {
        } else { e.preventDefault();  }  
    });



    $( ".numericsAndLetters" ).keydown(function(e) 
    {
    	//       rango de letras               tabulador       regreso        suprimir        fecha izq       flecha der        espacio              ñ  
    	if ((e.which>=65  && e.which<=90) ||  e.which== 9 || e.which== 8 ||  e.which== 46 || e.which== 37 || e.which== 39  || e.which== 32 || e.which== 192 ) {
      	} else if ((e.which>=96  && e.which<=105) || (e.which>=48  && e.which<=57) ) {
      	} else{ e.preventDefault(); 	}  
    });





    $( ".only-mayuzculas" ).keyup(function(e) 
    {
    	var dato = $(this).val().toUpperCase();
    	$(this).val(dato);


    });

    //$( ".only-mayuzculas" ).click(function(e) 
    //{
        
    //    $(this).select();
    //});

    function contarPuntos (dato, parametro)
    {
    	var contador 	= 	0;
    	var logitud 	=   dato.length;
    	for ( var k = 0;  k < logitud;  k = k +1 )
        {
            var c   = dato.charAt(k);
            if( c == parametro )
            {
                contador++;
            }
    	}
    	return contador;
    }
    
    function limpiarCadena(dato)
    {
        var cadena  =   '';
    	var logitud =   dato.length;
        var contador    =   0;
        
    	for ( var k = 0;  k < logitud;  k = k +1 )
        {
            var c   = dato.charAt(k);
            
            if( c == '-')
            {
                contador    =   contador +1;
            }
                
            if (contador < 3  &&   ( c == '-' || c == '1' || c == '2' || c == '3' || c == '4' || c == '5' || c == '6' || c == '7' || c == '8' || c == '9' || c == '0' ) )
            {
                cadena =  cadena+c;
                console.log(c);
            } 
    	}
    	return cadena;
    }


});