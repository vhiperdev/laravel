<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription Payment History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Subscription</li>
                        <li class="breadcrumb-item active">Subscription details</li>
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
                                        Renew/Pay Subscription
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Plan</th>
                                            <th>Reseller</th>
                                            <th>Subscription Due Date</th>
                                            <th>Subscription Duration</th>
                                            <th>Payment Status</th>
                                            <th>Payment Gateway</th>
                                            <th>Payment Type</th>
                                            <th>Payment Reference</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($history->resellerplan->name); ?></td>
                                            <td><?php echo e($history->reseller->name); ?></td>
                                            <td><?php echo e($history->next_due_date_payment); ?></td>
                                            <td><?php echo e($history->subscription_duration); ?></td>
                                            <td><?php if((int)$history->payment_status===1): ?> <span class="text-success">Paid</span> <?php else: ?> <span class="text-danger">Unpaid</span> <?php endif; ?></td>
                                            <td><?php echo e($history->payment_gateway); ?></td>
                                            <td><?php echo e($history->payment_type); ?></td>
                                            <td><?php echo e($history->payment_reference); ?></td>
                                            <td><?php echo e($history->created_at); ?></td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <?php if(COUNT($histories)==0): ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No history found</td>
                                        </tr>
                                        <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Plan</th>
                                            <th>Reseller</th>
                                            <th>Subscription Due Date</th>
                                            <th>Subscription Duration</th>
                                            <th>Payment Status</th>
                                            <th>Payment Gateway</th>
                                            <th>Payment Type</th>
                                            <th>Payment Reference</th>
                                            <th>Payment Date</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Recurrent Subscription Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('reseller.subscription.history', ['id'=> $subscription->id])); ?>">
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
                                                <label>Payment Option</label>
                                                <select name="payment_option" class="form-control select2  <?php $__errorArgs = ['payment_option'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('payment_option')); ?>" autocomplete="payment_option" autofocus>
                                                    <option>--choose--</option>
                                                    <option value="pos">POS</option>
                                                    <option value="terminal">Terminal</option>
                                                </select>
                                                <?php $__errorArgs = ['payment_option'];
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
                                            <button type="submit" class="btn btn-primary">Pay</button>
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
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller/subscription-payment-history.blade.php ENDPATH**/ ?>