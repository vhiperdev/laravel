<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reseller Subscription</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reseller Subscription</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Subscriptions</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Create Subscription
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Reseller</th>
                                        <th>Next Due Date</th>
                                        <th>Subscription Duration</th>
                                        <th>Status</th>
                                        <th>Date Subscribed</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($subscription->resellerPlan->name); ?></td>
                                        <td><?php echo e($subscription->reseller->name); ?></td>
                                        <td><?php echo e($subscription->next_due_date); ?></td>
                                        <td><?php echo e($subscription->subscription_duration); ?></td>
                                        <td><?php if($subscription->active_status === 1): ?> <span class="text-success">Active</span> <?php else: ?> <span class="text-danger">Inactive</span> <?php endif; ?></td>
                                        <td><?php echo e($subscription->created_at); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?php echo e(route('reseller.subscription.history.list', ['id'=>$subscription->id])); ?>">Subscription Payment History</a>
                                                    <a class="dropdown-item" href="<?php echo e(route('reseller.subscription.edit', ['id'=>$subscription->id])); ?>">Edit Subscription</a>
                                                    <a class="dropdown-item" href="<?php echo e(route('reseller.subscription.history.list', ['id'=>$subscription->id])); ?>">Renew</a>
                                                    <a class="dropdown-item text-danger" href="<?php echo e(route('reseller.subscription.disable', ['id'=>$reseller->id])); ?>" onclick="return confirm('Are you sure you want to delete this subscription?')">Disable/deactivate</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Reseller</th>
                                        <th>Next Due Date</th>
                                        <th>Subscription Duration</th>
                                        <th>Status</th>
                                        <th>Date Subscribed</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create New Subscription</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('reseller.subscriptions.store', ['id'=> $reseller->id])); ?>">
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
                                                <label>Plan</label>
                                                <select name="plan" id="plan" class="form-control select2  <?php $__errorArgs = ['plan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('plan')); ?>" autocomplete="plan" autofocus>
                                                    <option>--choose--</option>
                                                    <?php $__currentLoopData = $resellerPlan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($plan->id); ?>"> <?php echo e($plan->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['plan'];
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
                                                    <option>--choose--</option>
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


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });

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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller/subscription.blade.php ENDPATH**/ ?>