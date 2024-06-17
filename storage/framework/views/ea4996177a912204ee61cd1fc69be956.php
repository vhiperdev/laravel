<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($customer->name); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.all_customer')); ?></li>
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
                                        <div class='customer_details_name'><?php echo e(__('messages.customer_name')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->name); ?>

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.username')); ?>:</div>
                                        <div class='customer_details_value'>

                                            <?php echo e($customer->username); ?>


                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.whatsapp_number')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->whatsapp); ?>


                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.application')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->application); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.key')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->key); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.screen')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->screen); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.mac')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->mac); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.server_provider')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if($customer->get_server): ?><?php echo e($customer->get_server->name); ?><?php endif; ?>
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.application')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if($customer->get_application): ?><?php echo e($customer->get_application->name); ?><?php endif; ?>
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.device')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if($customer->get_device): ?><?php echo e($customer->get_device->name); ?><?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.password')); ?>:</div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->password); ?>

                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.created_at')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($customer->created_at); ?>

                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_plan')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if(count($customer->subscription)>0): ?>
                                            <?php echo e($customer->subscription[0]->productplan->plan->name); ?>

                                            <?php else: ?>
                                            Null
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_product')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if(count($customer->subscription)>0): ?>
                                            <?php echo e($customer->subscription[0]->productplan->product->name); ?>

                                            <?php else: ?>
                                            Null
                                            <?php endif; ?>
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_duration')); ?></div>
                                        <div class='customer_details_value'>

                                            <?php if(count($customer->subscription)>0): ?>
                                            <?php echo e($customer->subscription[0]->subscription_duration); ?>

                                            <?php else: ?>
                                            Null
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.subscription_due_date')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php if(count($customer->subscription)>0): ?>
                                            <?php echo e($customer->subscription[0]->next_due_date); ?>

                                            <?php else: ?>
                                            Null
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card mb-5 border-0">
                        <div class="card-header bg-white">
                            <?php echo e(__('messages.customer_subscription_history')); ?>

                        </div>
                        <div class="card-body bg-white">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td><?php echo e(__('messages.next_payment_due_date')); ?></td>
                                            <td><?php echo e(__('messages.payment_status')); ?></td>
                                            <td><?php echo e(__('messages.payment_type')); ?></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $customer->subscriptionPaymentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e(\Carbon\Carbon::parse($sub->next_due_date_payment)->format('d/m/Y H:i:s')); ?></td>
                                            <td><?php if($sub->payment_status===1): ?> paid <?php else: ?> unpaid <?php endif; ?></td>
                                            <td><?php echo e($sub->payment_type); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if(count($customer->subscriptionPaymentHistory)===0): ?>

                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4  mt-3">
                    <h3><?php echo e(__('messages.message_alert')); ?></h3>

                    <?php $__currentLoopData = $customer->get_alert_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="card shadow-none">
                        <div class="card-header bg-warning fw-bolder fs-6">
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

                    <?php if(count($customer->get_alert_history)==0): ?>
                    <span class="text-danger">No alert found</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/customers/show.blade.php ENDPATH**/ ?>