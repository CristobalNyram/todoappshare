<?php
define("__DIR_BASE__LOCAL__", dirname(__FILE__) . "./../../../");
define("__ACTIVE_PAGE_NAME__", "Login");
require_once(__DIR_BASE__LOCAL__ . "/app/Config/env.php");
$__ACTIVE_URL__ = "login";

UserSession::start();
if (UserSession::isAuthenticated() && UserSession::isAdmin()) {
    Redirection::to("pages/app/management/dashboard/");
} elseif (UserSession::isAuthenticated() && UserSession::isStudent()) {
    Redirection::to("pages/app/student/dashboard/");
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include_once(__DIR_BASE__LOCAL__ . "layouts/e-learning/head.php"); ?>

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
            <img src="<?php echo LOGO; ?>" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">

                <h2 class="mb-8">¡Bienvenido de nuevo! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Inicia sesión en tu cuenta y comienza la aventura.</p>

                <form id="login-form" action="#">
                    <div class="mb-24">
                        <label for="fname" class="form-label mb-8 h6">Email o Usuario</label>
                        <div class="position-relative">
                            <input type="text" class="form-control py-11 ps-40" id="fname" placeholder="Tu usuario o email">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-user"></i></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Contraseña actual</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="current-password" placeholder="Ingresa tu contraseña actual" value="">
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-main rounded-pill w-100">Iniciar sesión</button>

                    <?php #include_once(__DIR_BASE__LOCAL__ . "layouts/e-learning/auth/social-networks.php"); 
                    ?>

                </form>
            </div>
        </div>
    </section>

    <!-- Jquery js -->
    <?php include_once(__DIR_BASE__LOCAL__ . "app/includes/e-learning/script.php"); ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const loginForm = document.getElementById("login-form");
            const emailInput = document.getElementById("fname");
            const passwordInput = document.getElementById("current-password");

            loginForm.addEventListener("submit", async (e) => {
                e.preventDefault();

                const email = emailInput.value.trim();
                const password = passwordInput.value.trim();

                if (!email || !password) {
                    alert("Por favor completa todos los campos.");
                    return;
                }

                try {
                    const response = await fetch(BASE_URL_API + "V1/Auth/?action=login", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            email,
                            password
                        }),
                    });

                    const result = await response.json();
                    console.log(result);

                    if (response.ok) {
                        console.log("Login exitoso:", result);
                        let redirectTo = result.data.redirect_to || "<?php echo BASE_URL; ?>pages/e-learning/dashboard";
                        
                        // Redireccionar o guardar token
                        if (result.data && result.data.token) {
                        localStorage.setItem('Tk', result.data.token);
                        // console.log("Token guardado en localStorage");
                        }
                            

                        Swal.fire({
                            icon: 'success',
                            title: 'Login exitoso',
                            text: 'Redireccionando...',
                            showConfirmButton: false,
                            timer: 1500,
                            didClose: () => {
                                window.location.href = redirectTo;
                            }
                        });

                    } else {
                        console.error("Error en login:", result.message || "Error desconocido");
                        const htmlErrores = generateListErrors(result.errors);
                        Swal.fire({
                            icon: 'warning',
                            title: `${result.message || 'Aviso'}`,
                            html: `
                                <div style="text-align: center;">
                                    <div style="text-align: left; display: inline-block; margin: 0 auto;">
                                        ${htmlErrores}
                                    </div>
                                </div>
                            `,
                            confirmButtonText: 'Reintentar'
                        });
                    }
                } catch (error) {
                    console.error("Error de red:", error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor.',
                        confirmButtonText: 'Entendido'
                    });
                }
            });
        });
    </script>


</body>

</html>