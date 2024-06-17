<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(__('messages.reseller')); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.reseller')); ?></li>
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
                                    <h3 class="card-title"><?php echo e(__('messages.reseller')); ?></h3>
                                </div>
                                <div class="col-md-6 text-end">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="border-bottom">
                                            <th><?php echo e(__('messages.name')); ?></th>
                                            <th><?php echo e(__('messages.email')); ?></th>
                                            <th><?php echo e(__('messages.whatsapp_number')); ?></th>
                                            <th><?php echo e(__('messages.expiry_date')); ?></th>
                                            <th><?php echo e(__('messages.role')); ?></th>
                                            <th><?php echo e(__('messages.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $__currentLoopData = $resellers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="border-0">
                                            <td><?php echo e($resell->user->name); ?></td>
                                            <td><?php echo e($resell->user->email); ?></td>
                                            <td><?php echo e($resell->user->whatsapp); ?></td>
                                            <td> <?php echo e(\Carbon\Carbon::parse($resell->user->expiry_date)->format('d/m/Y H:i:s')); ?></td>
                                            <td><?php echo e($resell->role->name); ?> <?php echo e($resell->user->id); ?></td>
                                            <td>
                                                <a href="<?php echo e(route('reseller.show', ['id'=>$resell->user->id])); ?>" title="View details"><button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button></a>
                                                <a href="<?php echo e(route('reseller.edit', ['id'=>$resell->user->id])); ?>" title="Edit details"> <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button></a>
                                                <a href="<?php echo e(route('reseller.destroy', ['id'=>$resell->user->id])); ?>" title="Delete reseller" onclick="return confirm('<?php echo __('messages.confirm_delete_reseller'); ?>')"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                <a href="<?php echo e(route('reseller.customers', ['id'=>$resell->user->id])); ?>" title="Reseller Customer"><button class="btn btn-dark btn-sm"><i class="fa fa-users"></i></button></a>
                                                <button title="Alert Reseller" class="btn btn-secondary btn-sm alert-button" data-bs-toggle="modal" data-bs-target="#alertModal" data-item-id="<?php echo e($resell->user->id); ?>" data-item-name="<?php echo e($resell->name); ?>"><i class="fa fa-comment"></i></button>
                                                <a title="Reseller Subscription" href="<?php echo e(route('reseller.subscriptions', ['id'=>$resell->user->id])); ?>"><button class="btn btn-primary btn-sm"><i class="fa fa-briefcase"></i></button></a>
                                                <?php if($resell->isActive == 0): ?><a title="Activate Reseller Account" href="<?php echo e(route('reseller.activateDeactivate', ['id'=>$resell->user->id, 'status'=>'activate'])); ?>"><button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button></a><?php endif; ?>
                                                <?php if($resell->isActive == 1): ?><a title="Deactivate Reseller Account" href="<?php echo e(route('reseller.activateDeactivate', ['id'=>$resell->user->id, 'status'=>'deactivate'])); ?>"><button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button></a><?php endif; ?>

                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </tbody>
                                    <tfoot>
                                        <tr class="border-top-0">
                                            <th><?php echo e(__('messages.name')); ?></th>
                                            <th><?php echo e(__('messages.email')); ?></th>
                                            <th><?php echo e(__('messages.whatsapp_number')); ?></th>
                                            <th><?php echo e(__('messages.expiry_date')); ?></th>
                                            <th><?php echo e(__('messages.role')); ?></th>
                                            <th><?php echo e(__('messages.action')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Modal for Editing Item -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel modalItemName"><?php echo e(__('messages.alert')); ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo e(route('messaging.alert.reseller')); ?>" enctype="multipart/form-data">
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
                        <input name="reseller_id" id="modalItemId" value="<?php echo e(old('id')); ?>" type="hidden">


                        <div class="form-group">
                            <label for=""><?php echo e(__('messages.select_template')); ?></label>
                            <select name="message" class="form-control select2  <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="message" autofocus>
                                <option value="">--<?php echo e(__('messages.select_message')); ?>--</option>
                                <?php $__currentLoopData = $message_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($msgTag->id); ?>"><?php echo e($msgTag->title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>


                        <div class="container mt-4">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="toggleSwitch2">
                                <label class="form-check-label" for="toggleSwitch"><?php echo e(__('messages.compose_new_message')); ?></label>
                            </div>

                            <div class="togglevcard mt-3 d-none" id="toggleSection2">
                                <div class="form-group">
                                    <label><?php echo e(__('messages.message_title')); ?> </label>
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

                                                <label><?php echo e(__('messages.message')); ?></label>
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
                                                    <option value="">--<?php echo e(__('messages.select_tag')); ?>--</option>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('messages.close')); ?></button>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('messages.alert')); ?></button>
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



    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleSwitch2');
        var toggleSection = document.getElementById('toggleSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.alert-button');
        var modalItemId = document.getElementById('modalItemId')
        var modalItemName = document.getElementById('editModalLabel modalItemName')

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-item-id');
                var name = button.getAttribute('data-item-name');
                console.log({
                    id,
                    name
                })
                modalItemId.value = id;
                modalItemName.innerText = `Alert ${name}`;
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/reseller/index.blade.php ENDPATH**/ ?>