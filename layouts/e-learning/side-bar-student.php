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
    
    <a href="<?php echo BASE_URL; ?>pages/app/student/dashboard/" class="sidebar__logo text-center p-20 position-sticky inset-block-start-0 bg-white w-100 z-1 pb-10">
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
                <li hidden class="sidebar-menu__item <?php if (__ACTIVE_URL__ === "dashboard") {echo 'activePage'; }?>">
                    <a href="<?php echo BASE_URL; ?>pages/app/student/dashboard/" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-users-three"></i></span>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <li  class="sidebar-menu__item <?php if (__ACTIVE_URL__ === "student/my-courses") {echo 'activePage'; }?>">
                    <a href="<?php echo BASE_URL; ?>pages/app/student/tasks/" class="sidebar-menu__link">
                        <span class="icon"><i class="ph ph-book-open"></i></span>
                        <span class="text">Tareas</span>
                    </a>
                </li>
    
                
            </ul>
        </div>
  
    </div>
    

</aside>    
<!-- ============================ Sidebar End  ============================ -->