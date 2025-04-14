<?php if(auth()->guard()->check()): ?>
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        <a href="">Cashier APP</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
        <a href="">Cashier APP</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="<?php echo e(Request::is('home') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(url('home')); ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            
            <?php if(Auth::user()->role == 'superadmin'): ?>
            
            <li class="menu-header">Menu</li>
            <li class="<?php echo e(Request::is('product') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('products.index')); ?>"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a>
            </li>
            <li class="<?php echo e(Request::is('sales') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('sales.index')); ?>"><i class="fas fa-shopping-cart"></i> <span>Penjualan</span></a>
            </li>
            
            <li class="menu-header">User</li>
            <li class="<?php echo e(Request::is('user') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('user.index')); ?>"><i class="fas fa-user-shield"></i> <span>User</span></a>
            </li>
            <li class="<?php echo e(Request::is('members') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('members.index')); ?>"><i class="fas fa-user"></i> <span>Member</span></a>
            </li>

            <?php endif; ?>
            <?php if(Auth::user()->role == 'user'): ?>
            <li class="menu-header">Menu</li>
            <li class="<?php echo e(Request::is('product') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('products.index')); ?>"><i class="fas fa-shopping-bag"></i> <span>Produk</span></a>
            </li>
            <li class="<?php echo e(Request::is('sales') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('sales.index')); ?>"><i class="fas fa-shopping-cart"></i> <span>Penjualan</span></a>
            </li>

            
            <li class="menu-header">User</li>
            <li class="<?php echo e(Request::is('members') ? 'active' : ''); ?>">
                <a class="nav-link" href="<?php echo e(route('members.index')); ?>"><i class="fas fa-user"></i> <span>Member</span></a>
            </li>
            <?php endif; ?>
        </ul>
    </aside>
</div>
<?php endif; ?>
<?php /**PATH D:\Ujikom_12209277\cashierApp\resources\views/components/sidebar.blade.php ENDPATH**/ ?>