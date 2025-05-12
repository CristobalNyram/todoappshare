<script>

function mostrarContenidoEnModal(titulo, link,type="PDF") {
    var modalTitulo = document.getElementById('modaVisualizarArchivo-titulo');
    var modalContenido = document.getElementById('modaVisualizarArchivo-contenido');

    // Crear el div de carga con fondo oscuro
    var mensajeCarga = document.createElement('div');
    mensajeCarga.id = 'mensajeCarga';
    mensajeCarga.style.position = 'fixed';
    mensajeCarga.style.top = '0';
    mensajeCarga.style.left = '0';
    mensajeCarga.style.width = '100%';
    mensajeCarga.style.height = '100%';
    mensajeCarga.style.backgroundColor = 'rgba(0, 0, 0, 0.7)'; // Fondo azul oscuro
    mensajeCarga.style.color = '#fff'; // Color de texto blanco
    mensajeCarga.style.display = 'flex';
    mensajeCarga.style.alignItems = 'center';
    mensajeCarga.style.justifyContent = 'center';
    mensajeCarga.innerHTML = 'Cargando...';

    // Agregar el div de carga al contenido del modal
    modalContenido.innerHTML = '';
    modalContenido.appendChild(mensajeCarga);

    // Actualizar el título
    modalTitulo.innerText = titulo;

    // Crear el iframe
    if (type=="PDF") {
      var iframe = document.createElement('iframe');
      iframe.src = link;
      iframe.width = "100%";
      iframe.height = "400px";

      // Esperar a que el iframe se cargue completamente
      iframe.onload = function () {
          // Ocultar el div de carga una vez que el iframe se haya cargado
          mensajeCarga.style.display = 'none';
      
      };
       // Agregar el iframe al contenido del modal
       modalContenido.appendChild(iframe);
    }else{
      var video = document.createElement('video');
      video.src = link;
      video.width = "100%";
      video.height = "auto";
      video.controls = true; // Agregar controles de reproducción
      video.autoplay = true; // Habilitar autoplay

      // Agregar el video al contenido del modal
      modalContenido.appendChild(video);
      video.id = "player"; // Asignar un ID al elemento video

      const player = new Plyr('#player', {
          // Configuración adicional si es necesario
          controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
      });
      window.player = player;

      // Iniciar el reproductor Plyr
      // player.setup(video);
      mensajeCarga.style.display = 'none';

      
    }
  

   
    $('#modaVisualizarArchivo').on('hidden.bs.modal', function () {
        modalContenido.innerHTML = ''; // Limpiar el contenido
    });

}

</script>
<style>
  .modal-content {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    width: 100%;
    pointer-events: auto;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid rgba(0,0,0,.2);
    border-radius: .3rem;
    outline: 0;
    border-radius: 3rem;
}
</style>
<div class="modal fade" tabindex="-1" id="modaVisualizarArchivo">
<div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modaVisualizarArchivo-titulo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="modaVisualizarArchivo-contenido">

        </div>
     
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button> -->
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>