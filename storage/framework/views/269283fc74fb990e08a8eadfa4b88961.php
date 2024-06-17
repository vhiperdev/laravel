<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($reseller->name); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.reseller')); ?></li>
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
                <div class="col-12 col-md-8">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-5 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.name')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->name); ?>

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.email')); ?>:</div>
                                        <div class='customer_details_value'>

                                            <?php echo e($reseller->email); ?>


                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.whatsapp_number')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->whatsapp); ?>


                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.application')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->application); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.key')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->key); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.screen')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->screen); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.mac')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->mac); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.server_provider')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->user->get_server->name??null); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.application')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->user->get_application->name??null); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.device')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->user->get_device->name??null); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.role')); ?>:</div>
                                        <div class='customer_details_value'>
                                            Reseller
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_plan')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php if($reseller->subscription): ?>
                                            <?php echo e($reseller->subscription[0]->resellerPlan->name); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_next_due_date')); ?> :</div>
                                        <div class='customer_details_value'>
                                            <?php if($reseller->subscription): ?>
                                            <?php echo e($reseller->subscription[0]->next_due_date); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_duration')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php if($reseller->subscription): ?>
                                            <?php echo e($reseller->subscription[0]->subscription_duration); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.created_at')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($reseller->created_at); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4  mt-3">
                    <h3><?php echo e(__('messages.message_alert')); ?></h3>

                    <?php $__currentLoopData = $reseller->get_alert_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card shadow-none">
                        <div class="card-header bg-white fs-6">
                            <?php echo e(\Carbon\Carbon::parse($alert->created_at)->format('d/m/Y H:i:s')); ?>

                        </div>
                        <div class="card-body bg-white">
                            <?php echo e($alert->message_content); ?>


                        </div>
                        <div class="card-footer bg-white">
                            <?php if($alert->delivery_status): ?>
                            <span class="text-success">Delivered</span>
                            <?php else: ?>
                            <span class="text-danger">Not delivered</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if(count($reseller->get_alert_history)==0): ?>
                    <span class="text-danger"><?php echo e(__('messages.no_alert')); ?></span>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>
</div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller/show.blade.php ENDPATH**/ ?>