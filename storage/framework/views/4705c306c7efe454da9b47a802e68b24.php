<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title"><?php echo e(__('messages.referal_platform')); ?></h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?php echo e(__('messages.create_new')); ?>

                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $customer_referals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customerRef): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-1 shadow-sm">
                        <div class="card-body">
                            <div class="fs-5 fw-bolder"><?php echo e($customerRef->name); ?></div>
                            <div class="fs-6 fw-lighter"><?php echo e(__('messages.cost_per_user')); ?>: <?php echo e($settings->currencyDetails->symbol); ?><?php echo e($customerRef->cost_per_customer); ?></div>
                            <div class="fs-6 fw-lighter"> <?php echo e(__('messages.amount_earned')); ?>: <?php echo e($settings->currencyDetails->symbol); ?><?php echo e($customerRef->amount_earned); ?></div>
                            <div class="fs-6 fw-lighter"><?php echo e(__('messages.date_added')); ?>: <?php echo e($customerRef->created_at); ?></div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md">
                                    <button class="btn btn-sm btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-item-id="<?php echo e($customerRef->id); ?>" data-item-name="<?php echo e($customerRef->name); ?>" data-item-cost_per_customer="<?php echo e($customerRef->cost_per_customer); ?>" data-item-amount_earned="<?php echo e($customerRef->amount_earned); ?>">
                                        <i class="fa fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                    </button>
                                    <a href="<?php echo e(route('customer_referal.destroy', ['id'=>$customerRef->id])); ?>" onclick="return confirm('<?php echo __('messages.delete_message'); ?>')">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> <?php echo e(__('messages.delete')); ?>

                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <!-- create new Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('messages.create_new_referal_program')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo e(route('customer_referal.store')); ?>" enctype="multipart/form-data">
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
                            <label><?php echo e(__('messages.name')); ?></label>
                            <input name="name" class="form-control select2  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('name')); ?>" autocomplete="name" autofocus>

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

                        <div class="form-group">
                            <label><?php echo e(__('messages.cost_per_referal')); ?></label>
                            <input name="cost_per_customer" class="form-control select2  <?php $__errorArgs = ['cost_per_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('cost_per_customer')); ?>" autocomplete="cost_per_customer" autofocus>

                            <?php $__errorArgs = ['cost_per_customer'];
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
                            <label><?php echo e(__('messages.amount_earned')); ?></label>
                            <input name="amount_earned" class="form-control select2  <?php $__errorArgs = ['amount_earned'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('amount_earned')); ?>" autocomplete="amount_earned" autofocus>

                            <?php $__errorArgs = ['amount_earned'];
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
                        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.create')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><?php echo e(__('messages.edit_application')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="<?php echo e(route('customer_referal.update')); ?>" enctype="multipart/form-data">
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
                        <input name="id" id="editItemId" value="<?php echo e(old('id')); ?>" type="hidden">

                        <div class="form-group">
                            <label><?php echo e(__('messages.application_name')); ?></label>
                            <input name="name" id="editItemName" class="form-control select2  <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('name')); ?>" autocomplete="name" autofocus>

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

                        <div class="form-group">
                            <label><?php echo e(__('messages.cost_per_referal')); ?></label>
                            <input name="cost_per_customer" id="costPerCustomer" class="form-control select2  <?php $__errorArgs = ['cost_per_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('cost_per_customer')); ?>" autocomplete="cost_per_customer" autofocus>

                            <?php $__errorArgs = ['cost_per_customer'];
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
                            <label><?php echo e(__('messages.amount_earned')); ?></label>
                            <input name="amount_earned" id="amountEarned" class="form-control select2  <?php $__errorArgs = ['amount_earned'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('amount_earned')); ?>" autocomplete="amount_earned" autofocus>

                            <?php $__errorArgs = ['amount_earned'];
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
                        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.update')); ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editModalNameInput = document.getElementById('editItemName');
        var editModalIdInput = document.getElementById('editItemId');
        var costPerCustomer = document.getElementById('costPerCustomer');
        var amountEarned = document.getElementById('amountEarned');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                editModalNameInput.value = button.getAttribute('data-item-name');
                editModalIdInput.value = button.getAttribute('data-item-id');
                costPerCustomer.value = button.getAttribute('data-item-cost_per_customer');
                amountEarned.value = button.getAttribute('data-item-amount_earned');

            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/settings/customer_referals.blade.php ENDPATH**/ ?>