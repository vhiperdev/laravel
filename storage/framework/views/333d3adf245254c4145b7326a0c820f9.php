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
                <div class="card-header text-center"> Hello <?php echo e(auth()->user()->name); ?>.</div>
                <div class="card-body">
                    <div class="alert alert-warning" role="alert">
                        Your subscription has expired. Please renew your subscription to continue accessing our services or if you are a new user kindly pay to activate your account.
                    </div>

                    <form method="POST" action="<?php echo e(route('payment.createPayment')); ?>">

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

                        <div class="fw-bold">Pay with</div>

                        <img src="<?php echo e(asset('dist/img/logo-mercadopago.png')); ?>">


                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary w-100 mt-5">Pay Now</button>

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
<?php echo $__env->make('layouts.app-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/auth/subscription/renewuser-subscription.blade.php ENDPATH**/ ?>