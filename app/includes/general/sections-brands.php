<section class="brand-two ">
            <div class="container">
                <div class="block-title">
                    <h2 class="block-title__title">Nuestros clientes y socios comerciales</h2><!-- /.block-title__title -->
                </div><!-- /.block-title -->
                <div class="brand-one__carousel owl-carousel owl-theme">
                 

                <?php
                // Ruta de la carpeta que contiene las imágenes
                $carpeta_imagenes = 'assets/images/brands/';

                // Obtener todas las imágenes en la carpeta
                $imagenes = glob($carpeta_imagenes . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

                // Recorrer las imágenes y mostrarlas
                foreach ($imagenes as $imagen) {
                    echo '<div class="item">';
                    echo '<img src="' . BASE_URL . '/' . $imagen . '" alt="">';
                    echo '</div>';
                }
                ?>

                    

                   

                    


                    
                    <!-- /.item -->
                </div><!-- /.brand-one__carousel owl-carousel owl-theme -->
            </div><!-- /.container -->
</section><!-- /.brand-one -->