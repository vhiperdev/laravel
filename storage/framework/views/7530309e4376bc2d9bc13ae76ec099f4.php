<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($pageTitle); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e($pageTitle); ?></li>
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
                                    <h3 class="card-title"><?php echo e($pageTitle); ?></h3>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('messages.plan')); ?></th>
                                        <th><?php echo e(__('messages.customer')); ?></th>
                                        <th><?php echo e(__('messages.next_due_date')); ?></th>
                                        <th><?php echo e(__('messages.status')); ?></th>
                                        <th><?php echo e(__('messages.date_subscribed')); ?></th>
                                        <th><?php echo e(__('messages.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($subscription->productplan->plan->name); ?></td>
                                        <td><?php echo e($subscription->customer->name??'null'); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($subscription->next_due_date )->format('d/m/Y H:i:s')); ?></td>
                                        <td><?php if($subscription->active_status === 1): ?> <span class="text-success"><?php echo e(__('messages.active')); ?></span> <?php else: ?> <span class="text-danger"><?php echo e(__('messages.inactive')); ?></span> <?php endif; ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($subscription->created_at )->format('d/m/Y H:i:s')); ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?php echo e(route('subscription.history', ['id'=>$subscription->id])); ?>"><?php echo e(__('messages.subscription_payment_history')); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route('subscription.edit', ['id'=>$subscription->id])); ?>"><?php echo e(__('messages.edit_subscription')); ?></a>
                                                    <!-- <a class="dropdown-item text-danger" href="<?php echo e(route('subscription.disable', ['id'=>$subscription->id])); ?>" onclick="return confirm('<?php echo __('messages.confirm_subscription_delete'); ?>')"><?php echo e(__('messages.disable_deactivate')); ?></a> -->
                                                    <a class="dropdown-item text-danger" href="<?php echo e(route('subscription.destroy', ['id'=>$subscription->id])); ?>" onclick="return confirm('<?php echo __('messages.confirm_subscription_delete'); ?>')"><?php echo e(__('messages.delete')); ?></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
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


    $(function() {
        $("#example3")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example3_wrapper .col-md-6:eq(0)");
        $("#example4").DataTable({
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/subscriptions/index.blade.php ENDPATH**/ ?>