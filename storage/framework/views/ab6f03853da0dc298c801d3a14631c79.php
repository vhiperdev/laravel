<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e($page_title); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e($page_title); ?></li>
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
                            <h3 class="card-title">All <?php echo e(__('messages.customer')); ?> <?php echo e(auth()->user()->hasRole("admin")? "including the ones created by all resellers":""); ?></h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('messages.name')); ?></th>
                                        <th><?php echo e(__('messages.username')); ?></th>
                                        <th><?php echo e(__('messages.whatsapp_number')); ?></th>
                                        <th><?php echo e(__('messages.expiry_date')); ?></th>
                                        <th><?php echo e(__('messages.screen')); ?></th>
                                        <th><?php echo e(__('messages.application')); ?></th>
                                        <th><?php echo e(__('messages.action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($customer->name); ?></td>
                                        <td><?php echo e($customer->username); ?></td>
                                        <td><?php echo e($customer->whatsapp); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($customer->expiry_date)->format('d/m/Y H:i:s')); ?></td>
                                        <td><?php echo e($customer->screen); ?></td>
                                        <td><?php if($customer->get_application): ?><?php echo e($customer->get_application->name); ?><?php endif; ?></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="<?php echo e(route('customers.show', ['id'=>$customer->id])); ?>"><?php echo e(__('messages.view_customer')); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route('customers.edit', ['id'=>$customer->id])); ?>"><?php echo e(__('messages.edit_customer')); ?></a>
                                                    <a class="dropdown-item text-warning alert-button" href="#" data-bs-toggle="modal" data-bs-target="#alertModal" data-item-id="<?php echo e($customer->id); ?>" data-item-name="<?php echo e($customer->name); ?>"><?php echo e(__('messages.alert_customer')); ?></a>
                                                    <a class="dropdown-item" href="<?php echo e(route('customers.subscriptions', ['id'=>$customer->id])); ?>"><?php echo e(__('messages.subscription')); ?></a>
                                                    <a class="dropdown-item renewal-button" data-bs-toggle="modal" data-bs-target="#renewalModal" data-item-id="<?php echo e($customer->id); ?>" data-item-name="<?php echo e($customer->name); ?>"><?php echo e(__('messages.renew_subscription')); ?></a>
                                                    <a class="dropdown-item text-danger" href="<?php echo e(route('customers.destroy', ['id'=>$customer->id])); ?>" onclick="return confirm('Are you sure you want to delete this customer?')"><?php echo e(__('messages.delete')); ?></a>
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


<!-- Modal for Editing Item -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel modalItemName">Alert </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(route('messaging.alert.customer')); ?>" enctype="multipart/form-data">
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
                    <input name="customer_id" id="modalItemId" value="<?php echo e(old('id')); ?>" type="hidden">


                    <div class="form-group">
                        <label for="">Select Template</label>
                        <select name="message" class="form-control select2  <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="message" autofocus>
                            <option value="">--select Message--</option>
                            <?php $__currentLoopData = $message_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($msgTag->id); ?>"><?php echo e($msgTag->title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>


                    <div class="container mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggleSwitch2">
                            <label class="form-check-label" for="toggleSwitch">Compose new message</label>
                        </div>

                        <div class="togglevcard mt-3 d-none" id="toggleSection2">
                            <div class="form-group">
                                <label>Message Title</label>
                                <input name="title" id="editItemTitle" class="form-control select2  <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('title')); ?>" autocomplete="title" autofocus>

                                <?php $__errorArgs = ['title'];
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
                                <div class="container-fluid mb-2">
                                    <div class="row">
                                        <div class="col-6">

                                            <label>Message</label>
                                        </div>
                                        <div class="col-6">
                                            <select name="tag" id="tagSelect2" class="form-control select2  <?php $__errorArgs = ['tag'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="tag" autofocus>
                                                <option value="">--select tag--</option>
                                                <?php $__currentLoopData = $message_tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option><?php echo e($msgTag->tag); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="content" id="editItemContent contentTextarea2" class="form-control select2  <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="content" autofocus rows="10"><?php echo e(old('content')); ?></textarea>

                                <?php $__errorArgs = ['content'];
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Alert</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="renewalModal" tabindex="-1" aria-labelledby="renewalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="renewalModalLabel">Renew Subscription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(route('customer.subscriptions.renewal')); ?>">
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

                    <input type="hidden" id="renewalModalItemId" name="customer">

                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <div class="form-group">
                            <label>Expiring Date</label>
                            <input name="expiry_date" type="datetime-local" class="form-control select2  <?php $__errorArgs = ['next_due_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('expiry_date')); ?>" autocomplete="expiry_date" autofocus>

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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>

            </form>
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
                pageLength: 100
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


    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.renewal-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-item-id');

                document.getElementById('renewalModalItemId').value = id;
                document.getElementById('renewalModalItemPlanId').value = plan_id;

            });
        });
    });
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/customers/index.blade.php ENDPATH**/ ?>