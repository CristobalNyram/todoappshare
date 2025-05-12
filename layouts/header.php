            <!-- HEADER START -->


            <?php
            $__ACTIVE_URL__ = isset($__ACTIVE_URL__) ? $__ACTIVE_URL__ : "";
            ?>
            <style>
                .current-link {
                    color: #dc5e0c !important;
                }
            </style>

            <div class="topbar-one">
                <div class="container">
                    <div class="topbar-one__left">
                        <a href="#">contacto@trainingmidas.com</a>
                        <!-- <a href="#">444 888 0000</a> -->
                    </div><!-- /.topbar-one__left -->
                    <div class="topbar-one__right">

                        <?php if (!isset($__USER__)) { ?>
                            <a
                                href="<?php echo BASE_URL; ?>pages/auth/login"
                                <?php echo ($__ACTIVE_URL__ ==  'login' ? 'class="current-link"' : ''); ?>>Iniciar sesión </a>
                            <a
                                <?php echo ($__ACTIVE_URL__ ==  'registro' ? 'class="current-link"' : ''); ?>

                                href="<?php echo BASE_URL; ?>pages/auth/register">Registrarse</a>
                        <?php } ?>




                    </div><!-- /.topbar-one__right -->
                </div><!-- /.container -->
            </div><!-- /.topbar-one -->
            <header class="site-header site-header__header-one ">
                <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
                    <div class="container clearfix">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="logo-box clearfix">
                            <a class="navbar-brand" href="<?php echo BASE_URL; ?>pages/web/index">
                                <img src="<?php echo LOGO ?>" class="main-logo"
                                    width="220" alt="Training midas academy" />
                            </a>
                            <!-- <div class="header__social">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div> -->
                            <!-- /.header__social -->
                            <button class="menu-toggler" data-target=".main-navigation">
                                <span class="kipso-icon-menu"></span>
                            </button>
                        </div><!-- /.logo-box -->
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="main-navigation">
                            <ul class=" navigation-box">
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'index' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/index">Inicio</a>
                                    <!-- <ul class="sub-menu" >
                            <li><a href="index.html">Home 01</a></li>
                                    <li><a href="index-2.html">Home 02</a></li>
                                    <li><a href="index-3.html">Home 03</a></li>
                                    <li><a href="#">Header Versions</a>
                                        <ul class="sub-menu">
                                            <li><a href="index.html">Header 01</a></li>
                                            <li><a href="index-2.html">Header 02</a></li>
                                            <li><a href="index-3.html">Header 03</a></li>
                                        </ul>
                                    </li>
                        </ul> -->
                                    <!-- /.sub-menu -->
                                </li>
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'courses' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/courses">Cursos</a>

                                </li>
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'pricing' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/pricing">Planes</a>
                                </li>
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'about' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/about"
                                        <?php echo (CURRENT_URL === BASE_URL . '/about.php' ? 'class="active"' : ''); ?>>Nosotros</a>


                                </li>

                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'teachers' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/teachers"
                                        <?php echo (CURRENT_URL === BASE_URL . '/teachers.php' ? 'class="active"' : ''); ?>>Facilitadores</a>

                                </li>
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'faq' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/faq">Preguntas frecuentes</a>
                                </li>

                                <li hidden>
                                    <a href="news.html">News</a>
                                    <ul class="sub-menu">
                                        <li><a href="news.html">News Page</a></li>
                                        <li><a href="news-details.html">News Details</a></li>
                                    </ul><!-- /.sub-menu -->
                                </li>
                                <li
                                    <?php echo ($__ACTIVE_URL__ ==  'contact' ? 'class="current"' : ''); ?>>
                                    <a
                                        href="<?php echo BASE_URL; ?>pages/web/contact">Contacto</a>
                                </li>

                            
                                <?php if (UserSession::isAuthenticated()): ?>
                                    <li>
                                        <a href="#"> <i class="fas fa-user"></i> Cuenta</a>
                                        <ul class="sub-menu">
                                            <?php if (UserSession::isAdmin() || UserSession::isSuperAdmin()): ?>
                                                <li><a href="<?php echo BASE_URL; ?>pages/e-learning/management/dashboard/"><i class="fas fa-user-shield"></i> Panel</a></li>
                                            <?php elseif (UserSession::isStudent()): ?>
                                                <li><a href="<?php echo BASE_URL; ?>pages/e-learning/student/dashboard/"><i class="fas fa-user-graduate"></i> Panel</a></li>
                                            <?php elseif (UserSession::isTeacher()): ?>
                                                <li><a href="<?php echo BASE_URL; ?>pages/e-learning/teacher/dashboard/"><i class="fas fa-chalkboard-teacher"></i> Panel</a></li>
                                            <?php else: ?>
                                                <li><a href="<?php echo BASE_URL; ?>pages/e-learning/profile/me/"><i class="fas fa-user"></i> Panel </a></li>
                                            <?php endif; ?>

                                            <li><a href="" onclick="sessionClose(); return false;"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>



                            </ul>
                        </div><!-- /.navbar-collapse -->
                        <!-- <div class="right-side-box"> -->
                        <!-- <a class="header__search-btn search-popup__toggler" href="#"><i class="kipso-icon-magnifying-glass"></i> -->
                        <!-- /.kipso-icon-magnifying-glass --></a>
                        <!-- </div> -->
                        <!-- /.right-side-box -->
                    </div>
                    <!-- /.container -->
                </nav>
                <div class="site-header__decor">
                    <div class="site-header__decor-row">
                        <div class="site-header__decor-single">
                            <div class="site-header__decor-inner-1"></div><!-- /.site-header__decor-inner -->
                        </div><!-- /.site-header__decor-single -->
                        <div class="site-header__decor-single">
                            <div class="site-header__decor-inner-2"></div><!-- /.site-header__decor-inner -->
                        </div><!-- /.site-header__decor-single -->
                        <div class="site-header__decor-single">
                            <div class="site-header__decor-inner-3"></div><!-- /.site-header__decor-inner -->
                        </div><!-- /.site-header__decor-single -->
                    </div><!-- /.site-header__decor-row -->
                </div>
                <!-- site-header__decor -->
            </header><!-- /.site-header -->
            <!-- HEADER END -->