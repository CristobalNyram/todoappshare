<script type="text/javascript" src="<?php echo BASE_URL; ?>assets/js/general/libs/sweetalert2@11.js?v=<?php echo APP_VERSION; ?>"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/owl.carousel.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/waypoints.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.counterup.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/TweenMax.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/wow.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/countdown.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/vegas.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.validate.min.js"></script>
    <script src="<?php echo BASE_URL; ?>assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- template scripts -->
    <script src="<?php echo BASE_URL; ?>assets/js/theme.js"></script>
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65baf1c50ff6374032c75e1b/1hlh40qni';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
   <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Selecciona todos los elementos de video con la clase .video-protected
        const videos = document.querySelectorAll('.video-protected');

        // Itera sobre cada elemento de video y aplica Plyr
        videos.forEach(video => {
            const player = new Plyr(video, {
                // Configuración adicional si es necesario
                controls: ['play', 'progress', 'current-time', 'mute', 'volume', 'fullscreen']
            });
            window.player = player;
        });
    });
</script>
 
