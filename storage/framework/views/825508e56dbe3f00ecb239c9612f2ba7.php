<?php $__env->startSection('content'); ?>
<style>
    .subscription-box {
        height: 100vh;
    }
</style>
<div class="subscription-box">
    <div class="row h-100 justify-content-center">
        <div class="col-md-4 my-auto">
            <div class="card card-outline card-primary">
                <div class="card-header text-center"> Welcome <?php echo e(auth()->user()->name); ?></div>
                <div class="card-body">
                    <div class="alert alert-success" role="alert">
                        Welcome! Experience the full range of our services by subscribing today. Choose a plan that suits your needs and enjoy exclusive benefits. Subscribe now and unlock a world of possibilities!
                    </div>

                    <?php echo e(__('Before proceeding, kindly choose a plan that best fit')); ?>

                    <form method="POST" action="<?php echo e(route('reseller.subscriptions.new.subscriber', ['id'=> auth()->user()->id, 'status'=>0])); ?>">

                        <?php echo csrf_field(); ?>

                        <?php if($errors->any()): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <?php endif; ?>

                        <div class="form-group mt-4">
                            <label>Plan</label>
                            <select name="plan_id" id="plan_id" class="form-control select2  <?php $__errorArgs = ['plan_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('plan_id')); ?>" autocomplete="plan_id" autofocus>
                                <option>--choose--</option>
                                <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($plan->id); ?>"> <?php echo e($plan->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['plan_id'];
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
                            <label>Duration</label>
                            <select name="subscription_duration" class="form-control select2  <?php $__errorArgs = ['subscription_duration'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('subscription_duration')); ?>" autocomplete="subscription_duration" autofocus>
                                <option value="">--choose--</option>
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


                        <div class="form-group mt-4">
                            <button class="btn btn-warning">Proceed</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
    const selectElement = document.getElementById('product_plan_id');

    async function fetchPlans() {
        var inputElement = document.getElementById("product");

        var inputValue = inputElement.value;

        await fetch(`/api/productplan/getplan/${inputValue}`)
            .then(response => {
                // Check if the request was successful (status code 200)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Parse the response as JSON  
                return response.json();
            })
            .then(data => {
                // Handle the parsed data
                console.log("inputValue", data);

                selectElement.innerHTML = '';

                // Add a default option
                const defaultOption = document.createElement('option');
                defaultOption.text = 'Select an option';
                selectElement.add(defaultOption);

                // Populate options from the fetched data
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.plan.name;
                    selectElement.add(option);
                });

            })
            .catch(error => {
                // Handle errors
                console.error('Error during fetch operation:', error);
            });

    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/auth/subscription/newuser-subscription.blade.php ENDPATH**/ ?>