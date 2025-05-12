//Dark mode
localStorage.setItem('dark-mode', 'true');

const btnSwitch = document.querySelector('#switch');
btnSwitch.addEventListener('click', () => {
    console.log(1);
    document.body.classList.toggle('dark');
    btnSwitch.classList.toggle('active');
    //Save on local storage
        
    if (document.body.classList.contains('dark')) 
    {
        $(".fg-text-actividad").removeClass('active-negro');
        $(".fg-text-actividad").addClass('active-blanco');
        localStorage.setItem('dark-mode', 'true');
        $(".video").attr("src","../img/icon/VIDEO.png");
        $(".pdf").attr("src","../img/icon/PDF.png");
        $(".ejercicio").attr("src","../img/icon/ejercicio.png");
        $(".unidad").attr("src","../img/icon/unidadd.png");
        $(".evaluacion").attr("src","../img/icon/evaluacion.png");
        
        
        $(".form-field").removeClass("input-login-white").addClass("input-login"); 
        // $(".btn-send").addClass("btn-login-white");
        $(".btn-send").removeClass("btn-login-white");
        $("#text-inicio").removeClass("text-login-white");
        
        /* 
        $("#id_imagen_logo_midas").attr("src","img/logo_b.png");
        $(".banner-image-login").attr("src","img/back.png"); 
        $(".img-logo-academy").attr("src","img/logos/academy_training_black.png");
        $(".logotipo-app img").attr("src","../img/logos/academy_training_black.png");
        */

        $("#id_imagen_logo_midas").attr("src","img/logos/logo_b.png");
        $(".banner-image-login").attr("src","img/home.jpg");
        $(".img-logo-academy").attr("src","img/logos/logo_b.png");
        $(".logotipo-app img").attr("src","../img/logos/logo_b.png");

    } 
    else 
    {
        $(".fg-text-actividad").addClass('active-negro');
        $(".fg-text-actividad").removeClass('active-blanco');
        localStorage.setItem('dark-mode', 'false');
        $(".video").attr("src","../img/icon/VIDEO_2.png");
        $(".pdf").attr("src","../img/icon/PDF_2.png");
        $(".ejercicio").attr("src","../img/icon/ejercicio_2.png");
        $(".unidad").attr("src","../img/icon/unidadd_2.png");
        $(".evaluacion").attr("src","../img/icon/evaluacion_2.png");
        
        
        $(".form-field").removeClass("input-login").addClass("input-login-white"); 
       // $(".btn-send").removeClass("btn-login-white");
        $(".btn-send").addClass("btn-login-white");
        $("#text-inicio").addClass("text-login-white");
        
       
        /* 
        $("#id_imagen_logo_midas").attr("src","img/logo.png");
        $(".banner-image-login").attr("src","img/back_claro.jpg"); 
        $(".img-logo-academy").attr("src","img/logos/academy_training_white.png");
        $(".logotipo-app img").attr("src","../img/logos/academy_training_white.png");
        */

        $("#id_imagen_logo_midas").attr("src","img/logos/logo.png");
        $(".banner-image-login").attr("src","img/home.jpg");
        $(".img-logo-academy").attr("src","img/logos/logo.png");
        $(".logotipo-app img").attr("src","../img/logos/logo.png");
       
    }
});


//Get dark mode whith local storage
if (localStorage.getItem('dark-mode') === 'true') {
    document.body.classList.add('dark');
    btnSwitch.classList.add('active');
} else {
    document.body.classList.remove('dark');
    btnSwitch.classList.remove('active');
}
