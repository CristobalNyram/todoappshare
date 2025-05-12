//Active menú
function activeMenu() {
    active = window.localStorage.getItem("activeMenu");
    const ini = document.querySelector("#home");
    const vid = document.querySelector("#videos");
    const pln = document.querySelector("#plain");
    const log = document.querySelector("#login");
    const sve = document.querySelector("#sve");
    if (active == "home") {
      ini.classList.add('active-menu');
    } else if (active == "video") {
      vid.classList.add('active-menu');
    } else if (active == "plain") {
      pln.classList.add('active-menu');
    } else if (active == "login") {
    //  log.classList.add('active-menu');
    }else if (active == "sve") {
      sve.classList.add('active-menu');
    }
}


//Funcion boton Menú
$('#btn-menu').on('click', function() {
    $('#btn-menu').toggleClass('btn-menu-close');
    $('#menu').toggleClass('toggle-menu');
    $('#navbar').toggleClass('toggle-menu-color');
    if ($('#menu').hasClass('toggle-menu')) {
        $('#menu a').on("click", function() {
            $('#menu').removeClass('toggle-menu');
        });
        $(window).scroll(function() {
            $('#menu').removeClass('toggle-menu');
            $('#btn-menu').removeClass('btn-menu-close');
        });
    }
});

$(window).scroll(function() {
  if ($("#navbar").offset().top > 60) {
    $("#navbar").addClass("navbar-scroll");
  } else {
    $("#navbar").removeClass("navbar-scroll");
  }
});


const togglePassword = document.querySelector('#togglePassword');
const password = document.querySelector('#txtpassword');

togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
