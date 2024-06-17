<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($plan->name); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.all_plan')); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <a href="<?php echo e(URL::previous()); ?>">
                <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-5 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.plan_name')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($plan->name); ?>

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.value')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($plan->value); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.created_at')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($plan->created_at); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller_plans/show.blade.php ENDPATH**/ ?>