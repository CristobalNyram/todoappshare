<?php
define("__DIR_BASE__LOCAL__",dirname(__FILE__)."./../../../");
require_once(__DIR_BASE__LOCAL__."/app/Config/env.php");
$__ACTIVE_URL__ = "reset-password";
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
                <h2 class="mb-8">Reset Password</h2>
                <p class="text-gray-600 text-15 mb-32">For <span class="fw-medium"> exampleinfo@mail.com</span> </p>

                <form action="#">
                    
                    <div class="mb-24">
                        <label for="new-password" class="form-label mb-8 h6">New Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="new-password" placeholder="Enter New Password" value="password">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#current-password"></span>
                        </div>
                    </div>
                    <div class="mb-24">
                        <label for="confirm-password" class="form-label mb-8 h6">Confirm Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="confirm-password" placeholder="Enter Confirm Password" value="password">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i class="ph ph-lock"></i></span>
                            <span class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash" id="#confirm-password"></span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-main rounded-pill w-100">Set New Password</button>

                    <a href="<?php echo BASE_URL; ?>pages/auth/login" class="mt-24 text-main-600 flex-align gap-8 justify-content-center"> <i class="ph ph-arrow-left d-flex"></i> Back To Login</a>
                    
                </form>
            </div>
        </div>
    </section>

        <!-- Jquery js -->
    <?php include_once __DIR_BASE__LOCAL__."app/includes/e-learning/script.php" ?>
    </body>
</html>