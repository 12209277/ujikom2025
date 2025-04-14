

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="main-content-table">
    <section class="section">
        <div class="margin-content">
            <div class="container-sm">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="section-body">
                    <div class="container-sm bg-white">
                     <?php if(Auth::user()->role == 'superadmin'): ?>
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                      <?php else: ?> 
                      <div class="section-body text-center p-4">
                          <h3 class="text-center">Total Pendapatan Hari Ini : Rp <?php echo e(number_format($totalSalesToday, 0, ',', '.')); ?></h3>
                      </div>
                      <?php endif; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  const ctx = document.getElementById('myChart');

  fetch('/chart-data')
    .then(response => response.json())
    .then(data => {
      new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    })
    .catch(error => console.error('Error:', error));
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Ujikom_12209277\cashierApp\resources\views/home.blade.php ENDPATH**/ ?>