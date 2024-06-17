<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">

                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <h5>Update Subscription</h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">All Subscription</li>
                            </ol>
                        </div>
                    </div>
                    <a href="<?php echo e(URL::previous()); ?>">
                        <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
                    </a>
                    <div class="card card-default mt-2">
                        <div class="card-header">
                            <h3 class="card-title">Update subscription</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">

                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <form method="POST" action="<?php echo e(route('reseller.subscription.update', ['id'=>$subscription->id])); ?>">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Duration</label>
                                            <select name="subscription_duration" class="form-control select2  <?php $__errorArgs = ['subscription_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('subscription_duration')); ?>" autocomplete="subscription_duration" autofocus>
                                                <option value="<?php echo e($subscription->subscription_duration); ?>"><?php echo e($subscription->subscription_duration); ?></option>
                                                <option value="monthly">Monthly</option>
                                                <option value="quarterly">Quarterly</option>
                                                <option value="anually">Anually</option>
                                            </select>
                                            <?php $__errorArgs = ['subscription_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Plan</label>
                                            <select name="plan_id" id="plan_id" class="form-control select2  <?php $__errorArgs = ['plan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('plan_id')?? $subscription->resellerplan->id); ?>" autocomplete="plan_id" autofocus>
                                                <?php $__currentLoopData = $resellerplan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="">--choose--</option>
                                                <option value="<?php echo e($productp->id); ?>" <?php if(old('plan_id', $subscription->resellerplan->id)==$productp->id): ?> selected <?php endif; ?>>
                                                    <?php echo e($productp->name); ?>

                                                </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['product_plan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($message); ?></strong>
                                            </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Expiring Date</label>
                                            <input name="next_due_date" type="datetime-local" class="form-control select2  <?php $__errorArgs = ['next_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('next_due_date')?? $subscription->next_due_date); ?>" autocomplete="next_due_date" autofocus>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-primary btn-md">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller/subscriptions-edit.blade.php ENDPATH**/ ?>