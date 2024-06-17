<?php $__env->startSection('content'); ?>

<?php
// Extract the years and counts
$years = $subscribersData->pluck('year')->toArray();
$subscribersCount = $subscribersData->pluck('count')->toArray();


// Extract the years and counts
$statusCounts = $subscribersData->pluck('count')->toArray();
$statusLabels = $subscribersData->pluck('active_status')->toArray();

// Encode the data to be used in JavaScript
$statusCounts2 = json_encode($statusCounts);
$statusLabels2 = json_encode($statusLabels);


?>



<?php $__env->startPush("header-includes"); ?>

<script src="https://raw.githubusercontent.com/nnnick/Chart.js/master/dist/Chart.bundle.js"></script>
<script>
    var year = <?php echo json_encode($years); ?>;
    var data_click = <?php echo json_encode($subscribersCount); ?>; // Sample click data

    var barChartData = {
        labels: year,
        datasets: [{
            label: '<?php echo __('messages.subscribers'); ?>',
            backgroundColor: "rgba(220,220,220,0.5)",
            data: data_click
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("subscribersThisYear").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: '<?php echo __('messages.number_of_subscribers_this_year'); ?>'
                }
            }
        });


        var label = <?php echo json_encode($statusLabels2); ?>;
        var statusCount = <?php echo json_encode($statusCounts2); ?>; // Sample click data


        var barChartData2 = {
            labels: label,
            datasets: [{
                label: '<?php echo __('messages.number_of_subscribers'); ?>',
                backgroundColor: "rgba(220,220,220,0.5)",
                data: statusCount
            }]
        };

        var ctxB = document.getElementById("customerStatistics").getContext("2d");

        window.myBar = new Chart(ctxB, {
            type: 'pie',
            data: barChartData2,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: 'rgb(0, 255, 0)',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Yearly Website Visitor'
                }
            }
        });
    }
</script>
<?php $__env->stopPush(); ?>



<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?php echo e(__('messages.dashboard')); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.dashboard')); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>



    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e($total_products); ?></h3>
                            <p><?php echo e(__('messages.total_products')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo e(route('products')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo e($total_plans); ?></h3>
                            <p><?php echo e(__('messages.total_plan')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo e(route('plans')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($total_customers); ?></h3>
                            <p> <?php echo e(__('messages.total_customer')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo e(route('customers')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>0</h3>
                            <p><?php echo e(__('messages.subscription')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?php echo e($active_subscriptions); ?></h3>
                            <p><?php echo e(__('messages.active_subscription')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?php echo e($inactive_subscriptions); ?></h3>
                            <p><?php echo e(__('messages.inactive')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="<?php echo e(route('plans')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo e($expiring_this_week); ?></h3>
                            <p><?php echo e(__('messages.expiring_this_week')); ?> </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="<?php echo e(route('subscriptions.expires_thisweek')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($resellers); ?></h3>
                            <p><?php echo e(__('messages.number_of_resellers')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="<?php echo e(route('customers')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($expiring_fiveDays); ?></h3>
                            <p><?php echo e(__('messages.expiring_fiveDays')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo e(route('subscriptions.expires_5days')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($expiring_threeDays); ?></h3>
                            <p><?php echo e(__('messages.expiring_threeDays')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo e(route('subscriptions.expires_3days')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo e($expiring_oneDays); ?></h3>
                            <p><?php echo e(__('messages.expiring_oneDays')); ?></p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="<?php echo e(route('subscriptions.expires_1day')); ?>" class="small-box-footer"><?php echo e(__('messages.more_info')); ?> <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="row">
                <section class="col-lg-7 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                <?php echo e(__('messages.subscriber_this_year')); ?>

                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="tab-content p-0">
                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px">
                                    <canvas id="subscribersThisYear" height="280" width="600"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="col-lg-5 connectedSortable">

                    <div class="card bg-gradient-info">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-th mr-1"></i>
                                <?php echo e(__('messages.anual_subscribers_statistics')); ?>

                            </h3>
                            <div class="card-tools">
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="chart" id="customerStatistics" style="
                                min-height: 250px;
                                height: 250px;
                                max-height: 250px;
                                max-width: 100%;
                            "></canvas>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>
</div>

<?php $__env->startPush('scripts'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/home.blade.php ENDPATH**/ ?>