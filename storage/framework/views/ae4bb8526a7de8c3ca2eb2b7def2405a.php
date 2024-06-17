<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(__('messages.bill_message_history')); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                </div>
            </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo e(__('messages.customer')); ?></h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('messages.name')); ?></th>
                                        <th><?php echo e(__('messages.whatsapp_number')); ?></th>
                                        <th><?php echo e(__('messages.delivery_status')); ?></th>
                                        <th><?php echo e(__('messages.date_sent')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($history->get_customer->name); ?></td>
                                        <td><?php echo e($history->get_customer->whatsapp); ?></td>
                                        <td> <?php if($history->notice_delivery_status): ?> <span class="text-success fw-bolder"><?php echo e(__('messages.sent')); ?></span> <?php else: ?> <span class="text-danger"><?php echo e(__('messages.not_sent')); ?></span> <?php endif; ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($history->created_at)->format('d/m/Y H:i:s')); ?></td>

                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th><?php echo e(__('messages.name')); ?></th>
                                        <th><?php echo e(__('messages.whatsapp_number')); ?></th>
                                        <th><?php echo e(__('messages.delivery_status')); ?></th>
                                        <th><?php echo e(__('messages.date_sent')); ?></th>
                                    </tr>
                                </tfoot>
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

    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleSwitch2');
        var toggleSection = document.getElementById('toggleSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.alert-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-item-id');
                var name = button.getAttribute('data-item-name');

                document.getElementById('modalItemId').value = id;
                document.getElementById('editModalLabel modalItemName').innerText = `Alert ${name}`;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var tagSelect = document.getElementById('tagSelect2');
        var contentTextarea = document.getElementById('editItemContent contentTextarea2');

        tagSelect.addEventListener('change', function() {
            var selectedTag = tagSelect.value;
            var cursorPos = contentTextarea.selectionStart;
            var content = contentTextarea.value;

            var newContent = content.slice(0, cursorPos) + selectedTag + content.slice(cursorPos);

            contentTextarea.value = newContent;
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/billings/history.blade.php ENDPATH**/ ?>