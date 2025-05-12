<?php
define("__DIR_BASE__LOCAL__",dirname(__FILE__)."./../../../");
require_once(__DIR_BASE__LOCAL__."/app/Config/env.php");
$__ACTIVE_URL__ = "forgot-password";
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
            <img src="<?php echo BASE_URL; ?>assets/e-learning/assets/images/thumbs/auth-img3.png" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="<?php echo BASE_URL; ?>pages/e-learning/dashboard" class="auth-right__logo">
                    <img src="<?php echo LOGO; ?>" alt="logo" width="145px">
                </a>
                <h2 class="mb-8">Forgot Password?</h2>
                <p class="text-gray-600 text-15 mb-32">Lost your password? Please enter your email address. You will receive a link to create a new password via email.</p>

                <form action="#">
                    <div class="mb-24">
                        <label for="email" class="form-label mb-8 h6">Email </label>
                        <div class="position-relative">
                            <input type="email" class="form-control py-11 ps-40" id="email" placeholder="Type your email address">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-envelope"></i></span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-main rounded-pill w-100">Send Reset Link</button>

                    <a href="<?php echo BASE_URL; ?>pages/auth/login" class="my-32 text-main-600 flex-align gap-8 justify-content-center"> <i class="ph ph-arrow-left d-flex"></i> Back To Login</a>

                    <ul class="flex-align gap-10 flex-wrap justify-content-center">
                        <li>
                            <a href="https://www.facebook.com" class="w-38 h-38 flex-center rounded-6 text-facebook-600 bg-facebook-50 hover-bg-facebook-600 hover-text-white text-lg">
                                <i class="ph-fill ph-facebook-logo"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.twitter.com" class="w-38 h-38 flex-center rounded-6 text-twitter-600 bg-twitter-50 hover-bg-twitter-600 hover-text-white text-lg">
                                <i class="ph-fill ph-twitter-logo"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.google.com" class="w-38 h-38 flex-center rounded-6 text-google-600 bg-google-50 hover-bg-google-600 hover-text-white text-lg">
                                <i class="ph ph-google-logo"></i>
                            </a>
                        </li>
                    </ul>
                    
                </form>
            </div>
        </div>
    </section>

        <!-- Jquery js -->
        <?php include_once __DIR_BASE__LOCAL__."app/includes/e-learning/script.php" ?>
    </body>
</html>