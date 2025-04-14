

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<!-- <div class="main-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('Dashboard')); ?>

                    <div>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
</div>  -->
<div class="main-content-table">
    <section class="section">
        <div class="margin-content">
            <div class="container-sm">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="section-body">
                    <div class="container-sm bg-white">
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
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
        data: {
          // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
            label: 'Laba Penjualan Minggu Ini',
            data: data,
            borderWidth: 1
          }]
        },
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

  // new Chart(ctx, {
  //   type: 'bar',
  //   data: {
  //     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
  //     datasets: [{
  //       label: 'Laba Penjualan Minggu Ini',
  //       data: [12, 19, 3, 5, 2, 3],
  //       borderWidth: 1
  //     }]
  //   },
  //   options: {
  //     scales: {
  //       y: {
  //         beginAtZero: true
  //       }
  //     }
  //   }
  // });
</script>
<?php $__env->stopPush(); ?>

<!-- <?php $__env->startPush('scripts'); ?>
<script>
  const ctx = document.getElementById('myChart');
  console.log('yeya')
  fetch('/dashboard/chart-data')
    .then(response => response.json())
    .then(data => {
      console.log('yeya')
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
<?php $__env->stopPush(); ?> -->
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Ujikom_12209277\cashierApp\resources\views/home.blade.php ENDPATH**/ ?>