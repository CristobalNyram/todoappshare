<?php
define("__DIR_BASE__LOCAL__",dirname(__FILE__)."./../../../");
require_once(__DIR_BASE__LOCAL__."/app/Config/env.php");
$__ACTIVE_URL__ = "verify-email";
define("__ACTIVE_URL__", $__ACTIVE_URL__);
?>
<!DOCTYPE html>
<html lang="en">
<?php include_once __DIR_BASE__LOCAL__."/layouts/e-learning/head.php" ?>
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
            <img src="<?php echo BASE_URL; ?>assets/e-learning/assets/images/thumbs/auth-img4.png" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="<?php echo BASE_URL; ?>pages/e-learning/dashboard" class="auth-right__logo">
                    <img src="<?php echo LOGO; ?>" alt="logo" width="145px">
                </a>
                <h2 class="mb-8">Verify your mail</h2>
                <p class="text-gray-600 text-15 mb-32">Account activation link sent to your email address:  <span class="fw-medium"> exampleinfo@mail.com</span> Please follow the link inside 
                    to continue. </p>
                    
                <a href="two-step-verification.html" class="btn btn-main rounded-pill w-100">Skip For Now</a>

                <p class="mt-32 text-gray-600 text-center">Didn't get the mail?
                    <a href="<?php echo BASE_URL; ?>pages/e-learning/forgot-password" class="text-main-600 hover-text-decoration-underline"> Resend</a>
                </p>
                
            </div>
        </div>
    </section>

        <!-- Jquery js -->
        <?php include_once __DIR_BASE__LOCAL__."app/includes/e-learning/script.php" ?>
    </body>
</html>