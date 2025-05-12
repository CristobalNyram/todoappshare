<?php 
if (!defined('__ACTIVE_URL__')) {
    define("__ACTIVE_URL__", "__ACTIVE_URL__");
}
?>   
    <!-- ============================ Sidebar Start ============================ -->

    <aside class="sidebar">
    <!-- sidebar close btn -->
     <button type="button" class="sidebar-close-btn text-gray-500 hover-text-white hover-bg-main-600 text-md w-24 h-24 border border-gray-100 hover-border-main-600 d-xl-none d-flex flex-center rounded-circle position-absolute"><i class="ph ph-x"></i></button>
    <!-- sidebar close btn -->
    
    <a href="<?php echo BASE_URL; ?>pages/app/management/dashboard/" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
        <img src="<?php echo LOGO; ?>" alt="Logo" width="145" height="42">
    </a>

    <div class="sidebar-menu-wrapper overflow-y-auto scroll-sm">
        <div class="p-20 pt-10">
            <ul class="sidebar-menu">

                <li hidden class="sidebar-menu__item <?php if (__ACTIVE_URL__ === "students") {echo 'activePage'; }?>">
                    <a href="<?php echo BASE_URL; ?>pages/app/students/" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-users-three"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>
                <li  class="sidebar-menu__item <?php if (__ACTIVE_URL__ === "dashboard") {echo 'activePage'; }?>">
                    <a href="<?php echo BASE_URL; ?>pages/app/management/dashboard/" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-users-three"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-menu__item">
                    <span class="text-gray-300 text-sm px-20 pt-20 fw-semibold border-top border-gray-100 d-block text-uppercase">Gestión</span>
                </li>
                <?php if (UserSession::hasAnyPermission(['users.index', 'students.index', 'teachers.index'])): ?>

                    <li class="sidebar-menu__item has-dropdown">
                        <a href="javascript:void(0)" class="sidebar-menu__link">
                            <span class="icon"><i class="ph ph-users-three"></i></span>
                            <span class="text">Usuarios</span>
                        </a>
                        <!-- Submenu start -->
                        <ul class="sidebar-submenu">
                            <?php if (UserSession::hasPermission('users.index')): ?>
                                <li class="sidebar-submenu__item <?php if (__ACTIVE_URL__ === 'users') echo 'activePage'; ?>">
                                    <a href="<?php echo BASE_URL; ?>pages/app/management/users/" class="sidebar-submenu__link"> General </a>
                                </li>
                            <?php endif; ?>
                            <?php if (UserSession::hasPermission('students.index')): ?>
                            <li class="sidebar-submenu__item <?php if (__ACTIVE_URL__ == "students") {echo 'activePage'; }?>">
                                <a href="<?php echo BASE_URL; ?>pages/app/management/students/" class="sidebar-submenu__link"> Estudiantes </a>
                            </li>
                            <?php endif; ?>



                        </ul>
                        <!-- Submenu End -->
                    </li>

                <?php endif; ?>
    
                
            </ul>
        </div>
  
    </div>
    

</aside>    
<!-- ============================ Sidebar End  ============================ -->