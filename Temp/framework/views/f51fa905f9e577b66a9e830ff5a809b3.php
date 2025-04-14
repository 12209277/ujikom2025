<?php if(auth()->guard()->check()): ?>
<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <!-- Sidebar Toggle Button on the Left -->
    <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
        <i class="fas fa-bars"></i>
    </a>

    <!-- Right Side Navbar Items -->
    <ul class="navbar-nav ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?php echo e(asset('img/avatar/avatar-1.png')); ?>" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">
                    Hai, <?php echo e(substr(auth()->user()->name, 0, 10)); ?>

                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">
                    Selamat Datang, <?php echo e(substr(auth()->user()->name, 0, 10)); ?>

                </div>
                <a class="dropdown-item has-icon edit-profile" href="<?php echo e(route('profile.edit')); ?>">
                    <i class="fa fa-user"></i> Edit Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo e(route('logout')); ?>" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
    </ul>
</nav>
<?php endif; ?>
<?php /**PATH D:\Ujikom_12209277\cashierApp\resources\views/components/header.blade.php ENDPATH**/ ?>