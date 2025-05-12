function getIfTutoriasWasSeen() 
{
    $.ajax({
        type     :  "POST",
        dataType :  "json",
        url      :  "../CapaDatosPermisos/getPermisos.php",
        async    : false, 
        cache    : false,
        data :  
        { 

        },
        success: function(data) 
        {
            if(data.respuesta == "Exito")
            {
               
                //alert(arrayPermisos);
            }
            else
            {
                alert(data.respuesta);
            }
        }
    }); 
}


$(document).ready(function(){

    let nombre_usuario = document.querySelector('.name').textContent;
    let intro_2 = introJs();
    intro_2.setOptions({
      tooltipPosition: 'auto',
      tooltipClass: 'custom-tooltip', /* Clase CSS adicional para estilizar la ventana */
      steps: [
        
        {
          element: '#btnBienvenidaAdelante',
          intro: `En el botón de  <i class="fas fa-arrow-circle-right"></i>  ADELANTE podrás continuar con la siguiente actividad. `,
          position: 'bottom',
        
        },
        {
          element: '#siguimientoCurso_2',
          intro: `En el botón de ATRÁS <i class="fa fa-arrow-circle-left"></i>  podrás regresar a la actividad anterior. `,
          position: 'bottom',
          

        },
        {
          element: '#btnBienvenidaContinuarAprendizaje',
          intro: `En el botón de CONTINUAR APRENDIZAJE <i class="fa fa-undo" aria-hidden="true"></i>  podrás continuar con la última actividad que has realizado.`,
          position: 'bottom',
        
        },
        {
          element: '#btnBienvenidaMenu',
          intro: `Con este botón podrás desplegar y ocultar el menú principal.`,
          position: 'bottom',
        
        },

        
       
       
    
      ],
      doneLabel: '<i class="fas fa-check"></i> Hecho',
      nextLabel: 'Adelante <i class="fas fa-arrow-circle-right"></i>',
      prevLabel: '<i class="fas fa-arrow-circle-left"></i> Atrás',
      overlayOpacity: 0.8
    
    
    })
    .oncomplete(function() {
   
    });
    
    let intro_1 = introJs();
    intro_1.setOptions({
      tooltipPosition: 'auto',
      tooltipClass: 'custom-tooltip', /* Clase CSS adicional para estilizar la ventana */
      steps: [
        {
            intro: `Bienvenido/a ${nombre_usuario}  a tu plataforma de aprendizaje Academy Training Midas diseñada para tener una enseñanza en constante crecimiento y puedas alcanzar tus objetivos y metas.`,
            position: 'center'
        },
        {
          element: '.account',
          intro: 'En este menú se encuentran varias opciones de configuración de tu cuenta.',
          position: 'left',
         
        },
        {
          element: '.mode',
          intro: 'Usa este interruptor para INTERCAMBIAR el aspecto del contraste entre claro y obscuro en la plataforma.',
          position: 'left',
        
        },
        {
          element: '.btn-update-password',
          intro: 'Te invitamos a cambiar tu contraseña para mayor seguridad.',
          position: 'left',
        },
        {
          element: '.btn-result-activities',
          intro: 'En este apartado podrás encontrar las evidencias de tus resultados,  que se generan al realizar las actividades del curso.',
          position: 'left',
        },
        {
          element: '.btn-close-session',
          intro: 'Aquí podrás cerrar tu sesión.',
          position: 'left',
        },
        {
          element: '.btn-menu-app',
          intro: 'Con este botón podrás desplegar y ocultar el menú principal.',
          position: 'bottom',
        },
        {
          element: '#iconmodule0',
          intro: 'Puedes desplegar las pestañas para descubrir los diferentes contenidos de cada módulo y unidad. ',
          position: 'right',
        
        },

        {
          element: '.btnBienvenidaModulo',
          intro: 'Puedes seleccionar el contenido que quieres reproducir,  guíate por los iconos que representan el tipo de formato del contenido: videos, archivos de texto, ejercicios y evaluaciones.',
          position: 'right',
        },
        {
          element: '#siguimientoCurso_2',
          intro: 'En los siguientes botones puedes adelantar o ir para atras en las diferentes actividades. ',
          position: 'bottom',
        
        },
  
       
       
    
      ],
      doneLabel: `Adelante <i class="fas fa-arrow-circle-right"></i>`,
      nextLabel: 'Adelante <i class="fas fa-arrow-circle-right"></i>',
      prevLabel: '<i class="fas fa-arrow-circle-left"></i> Atrás',
      overlayOpacity: 0.8
    
    
    })
    .oncomplete(function() {
      // Ocultar el elemento después de que el tutorial ha terminado
      $('.account ').removeClass('account-hover');
      // Almacenar un valor en localStorage para indicar que el tutorial ya se mostró y ha terminado
    localStorage.setItem('tutorialShown2', true);
    });
 

    intro_1.onafterchange(function(targetElement) {
      if (intro_1._currentStep === 1) {
        // Acción que se realizará después del segundo paso
        $('.account ').addClass('account-hover',()=>{
          $('.menu-account').addClass('background-padding');
          $('.mode').addClass('mtb-5');
          });

          /*
          let element_menu=document.querySelector('.app .section-header  .menu-account');
          const event = new MouseEvent('mouseenter', {
            bubbles: true,
            cancelable: true,
          });
          element_menu.dispatchEvent(event);
            */
      }

      if (intro_1._currentStep === 6) {
        // Acción que se realizará después del segundo paso
        $('.account ').removeClass('account-hover',()=>{

          if (document.body.classList.contains('dark')) {

          }else{
            
          }
          // $('.menu-account').addClass('background-padding');
          // $('.mode').addClass('mtb-5');
        });
      }
      if (intro_1._currentStep === 7) {
       

        if (!$('#iconmodule0').hasClass('rotate')) {
          activeModule('module0');

        } 
      }

      if (intro_1._currentStep === 8) {
       
      }


      if(intro_1._currentStep===9){
        
        $('#modulo0_bienvenida').trigger('click');

      }
    });

    if (!localStorage.getItem('tutorialShown2')) {
    intro_1.start();
    }
  
    intro_1.onexit(function() {
      $('.account ').removeClass('account-hover');

        //alert(2);
        localStorage.setItem('tutorialShown2', true);
        if(intro_1._currentStep===9){
          intro_2.start();

        }
 
  
    });



    function startTutorial(){
      intro_1.start();

    }

   // Obtener todos los elementos con la clase "my-button"
    var buttons_tutorial = document.getElementById('my-button-tutorial');


      buttons_tutorial.addEventListener('click', function() {
        // Acciones a realizar cuando se hace clic en el botón
        // Puedes agregar más acciones aquí
        startTutorial();
      });
  



   

});



