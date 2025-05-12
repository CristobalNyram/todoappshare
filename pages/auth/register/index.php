<?php 
define("__DIR_BASE__LOCAL__",dirname(__FILE__)."./../../../");
define("__ACTIVE_PAGE_NAME__","Registro");
require_once(__DIR_BASE__LOCAL__."/app/Config/env.php");
$__ACTIVE_URL__ = "register";

UserSession::start();
if (UserSession::isAuthenticated() && UserSession::isAdmin()) {
    Redirection::to("pages/e-learning/management/dashboard/");
} elseif (UserSession::isAuthenticated() && UserSession::isStudent()) {
    Redirection::to("pages/e-learning/student/dashboard/");
} elseif (UserSession::isAuthenticated() && UserSession::isTeacher()) {
    Redirection::to("pages/e-learning/teacher/dashboard/");
}else if (UserSession::isAuthenticated()) {
    Redirection::to("pages/e-learning/dashboard/");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR_BASE__LOCAL__."layouts/e-learning/head.php"); ?>
<body>
    
<!--==================== Preloader Start ====================-->
  <div class="preloader">
    <div class="loader"></div>
  </div>
<!--==================== Preloader End ====================-->

<!--==================== Sidebar Overlay End ====================-->
<div class="side-overlay"></div>
<!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="<?php echo BASE_URL; ?>assets/e-learning/assets/images/thumbs/auth-img2.png" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="<?php echo BASE_URL; ?>pages/web/index" class="auth-right__logo">
                    <img src="<?php echo LOGO; ?>" alt="logo" width="145">
                </a>
                <h2 class="mb-8">Regístrate</h2>
                <p class="text-gray-600 text-15 mb-32">Por favor regístrate y comienza la aventura.</p>

                <form action="#">
                    <div class="mb-24">
                        <label for="username" class="form-label mb-8 h6">Usuario</label>
                        <div class="position-relative">
                            <input type="text" class="form-control py-11 ps-40" id="username" placeholder="Ingresa tu usuario">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-user"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="email" class="form-label mb-8 h6">Email</label>
                        <div class="position-relative">
                            <input type="email" class="form-control py-11 ps-40" id="email" placeholder="Ingresa tu email">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-envelope"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Contraseña</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="current-password" placeholder="Ingresa tu contraseña" value="">
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                        </div>
                        <span class="text-gray-900 text-15 mt-4">Debe tener al menos 8 caracteres</span>
                    </div>
                    <?php include_once(__DIR_BASE__LOCAL__."layouts/e-learning/auth/social-networks-2.php"); ?>
                    
                </form>
            </div>
        </div>
    </section>

        <!-- Jquery js -->
        <?php include_once(__DIR_BASE__LOCAL__."app/includes/e-learning/script.php"); ?>
    </body>
</html>