$('#btn-menu-app').on('click',()=>{
  $('#btn-menu-app').toggleClass('active');
  if ($('#btn-menu-app').hasClass('active')) {
    localStorage.setItem('drawer', 'true');
    $('#btn-menu-app').toggleClass('active');
    $('#nav-bar-app').toggleClass('disable-nav-bar-app');
    $('#container-app').toggleClass('full-container-app');
  } else {
    localStorage.setItem('drawer', 'false');
    $('#btn-menu-app').removeClass('active');
    $('#nav-bar-app').removeClass('disable-nav-bar-app');
    $('#container-app').removeClass('full-container-app');
  }
});

if (localStorage.getItem('drawer') === 'true') {
  $('#btn-menu-app').toggleClass('active');
  $('#nav-bar-app').toggleClass('disable-nav-bar-app');
  $('#container-app').toggleClass('full-container-app');
} else {
  $('#btn-menu-app').removeClass('active');
  $('#nav-bar-app').removeClass('disable-nav-bar-app');
  $('#container-app').removeClass('full-container-app');
}

function activeModule(item) {
  $('#icon'+item).toggleClass('rotate');
  $('#'+item).toggleClass('active_unit');
}
function activeUnity(item) {
  $('#icon'+item).toggleClass('rotate');
  $('#'+item).toggleClass('active_activity');
}