<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($product->name); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <a href="<?php echo e(URL::previous()); ?>">
                        <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
                    </a>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?php echo e(__('messages.assign_plan')); ?>

                    </button>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-6 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.product_name')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($product->name); ?>

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.value')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($product->value); ?>

                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'><?php echo e(__('messages.created_at')); ?></div>
                                        <div class='customer_details_value'>
                                            <?php echo e($product->created_at); ?>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 text-start">
                                    <h2 class="fs-5 fw-bolder"><?php echo e(__('messages.product_plans')); ?></h2>
                                    <?php if(count($productPlan)): ?>

                                    <?php $__currentLoopData = $productPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $productPl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="card card-default shadow-none border">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-10">

                                                    <div>
                                                        <?php echo e($productPl->plan->name); ?>

                                                    </div>
                                                    <div>
                                                        <?php echo e($productPl->plan->value); ?>

                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <a href="<?php echo e(route('product.unasign.plan', ['id' => $productPl->id])); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <div class="text-secondary">No plan found</div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('messages.assign_new_plan')); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="<?php echo e(route('product.asign.plan', ['id' =>$product->id])); ?>">
                        <div class="modal-body">

                            <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>

                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label><?php echo e(__('messages.plan')); ?></label>
                                <select name="plan" class="form-control select2  <?php $__errorArgs = ['plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="plan" autofocus>
                                    <option>--choose--</option>

                                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($plan->id); ?>"><?php echo e($plan->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['name'];
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
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('messages.close')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('messages.assign')); ?></button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/products/show.blade.php ENDPATH**/ ?>