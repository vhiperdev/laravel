<?php $__env->startSection('content'); ?>
<div class="content-wrapper">

    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title"><?php echo e(__('messages.message_template')); ?> </h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <?php echo e(__('messages.create_new')); ?>

                            </button>
                        </div>

                        <div class="row mt-4">
                            <?php $__currentLoopData = $message_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg_template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                        <?php echo e($msg_template->title); ?>

                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md">
                                                <button class="btn btn-sm btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-item-id="<?php echo e($msg_template->id); ?>" data-item-title="<?php echo e($msg_template->title); ?>" data-item-content="<?php echo e($msg_template->content); ?>" data-item-vcard_name="<?php echo e($msg_template->vcard_name); ?>" data-item-vcard_number="<?php echo e($msg_template->vcard_number); ?>" data-item-image_attachment_url="<?php echo e($msg_template->image_attachment_url); ?>" data-item-video_attachment_url="<?php echo e($msg_template->video_attachment_url); ?>" data-item-audio_attachment_url="<?php echo e($msg_template->audio_attachment_url); ?>">
                                                    <i class="fa fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                                </button>
                                                <a href="<?php echo e(route('messaging.template.destroy', ['id'=>$msg_template->id])); ?>" onclick="return confirm('Are you sure you want to delete this template?')">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> <?php echo e(__('messages.delete')); ?>

                                                    </button>
                                                </a>
                                                <button class="btn btn-sm btn-info view-button" data-bs-toggle="modal" data-bs-target="#viewModal" data-item-title="<?php echo e($msg_template->title); ?>" data-item-content="<?php echo e($msg_template->content); ?>" data-item-vcard_name="<?php echo e($msg_template->vcard_name); ?>" data-item-vcard_number="<?php echo e($msg_template->vcard_number); ?>" data-item-image_attachment_url="<?php echo e($msg_template->image_attachment_url); ?>" data-item-video_attachment_url="<?php echo e($msg_template->video_attachment_url); ?>" data-item-audio_attachment_url="<?php echo e($msg_template->audio_attachment_url); ?>">
                                                    <i class="fa fa-eye"></i> <?php echo e(__('messages.view')); ?>

                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>


                        <!-- Modal for Editing Item -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel"><?php echo e(__('messages.edit_message')); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="<?php echo e(route('messaging.template.update')); ?>" enctype="multipart/form-data">
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
                                            <input name="id" id="editItemId" value="<?php echo e(old('title')); ?>" type="hidden">

                                            <div class="form-group">
                                                <label><?php echo e(__('messages.message_title')); ?></label>
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
                                                                <option>--<?php echo e(__('messages.select_tag')); ?>--</option>
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

                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleSwitch2">
                                                    <label class="form-check-label" for="toggleSwitch"><?php echo e(__('messages.add_card')); ?></label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleSection2">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.vcard_name')); ?></label>
                                                        <input name="vcard_name" id="editItemVcardName" class="form-control select2" style="width: 100%" value="<?php echo e(old('vcard_name')); ?>" autocomplete="vcard_name" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.vcard_number')); ?></label>
                                                        <input name="vcard_number" id="editItemVcardNumber" class="form-control select2" style="width: 100%" value="<?php echo e(old('vcard_number')); ?>" autocomplete="vcard_number" autofocus>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleMediaSwitch2">
                                                    <label class="form-check-label" for="toggleSwitch"><?php echo e(__('messages.attach_media')); ?></label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleMediaSection2">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_image')); ?></label>
                                                        <input name="image_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('image_attachment_url')); ?>" autocomplete="image_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_video')); ?></label>
                                                        <input name="video_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('video_attachment_url')); ?>" autocomplete="video_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_audio')); ?></label>
                                                        <input name="audio_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('audio_attachment_url')); ?>" autocomplete="audio_attachment_url" autofocus>
                                                    </div>
                                                </div>
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

                        <!-- Modal for Viewing Item -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel"><?php echo e(__('messages.message_details')); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Place the content you want to display in the modal here -->
                                        <b class="text-dark"><?php echo e(__('messages.title')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemTitle"></div>
                                        <b class="text-dark"><?php echo e(__('messages.content')); ?>:</b>
                                        <div class="text-secondary mb-4 border p-2" id="modalItemContent"></div>
                                        <b class="text-dark"><?php echo e(__('messages.vcard_name')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemVcard_name"></div>
                                        <b class="text-dark"><?php echo e(__('messages.vcard_number')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemVcard_number"></div>
                                        <b class="text-dark"><?php echo e(__('messages.image_attachment')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemImage_attachment_url"></div>
                                        <b class="text-dark"><?php echo e(__('messages.video_attachment')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemVideo_attachment_url"></div>
                                        <b class="text-dark"><?php echo e(__('messages.audio_attachment')); ?>:</b>
                                        <div class="text-secondary mb-4" id="modalItemAudio_attachment_url"></div>
                                        <!-- Add other details as needed -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- create new Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('messages.create_new_message')); ?></h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="<?php echo e(route('messaging.template.store')); ?>" enctype="multipart/form-data">
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
                                                <label><?php echo e(__('messages.message_title')); ?></label>
                                                <input name="title" class="form-control select2  <?php $__errorArgs = ['title'];
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
                                                            <select name="tag" id="tagSelect" class="form-control select2  <?php $__errorArgs = ['tag'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="tag" autofocus>
                                                                <option>--<?php echo e(__('messages.select_tag')); ?>--</option>
                                                                <?php $__currentLoopData = $message_tag; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option><?php echo e($msgTag->tag); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <textarea name="content" id="contentTextarea" class="form-control select2  <?php $__errorArgs = ['content'];
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

                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleSwitch">
                                                    <label class="form-check-label" for="toggleSwitch"><?php echo e(__('messages.add_vcard')); ?></label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleSection">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.vcard_name')); ?></label>
                                                        <input name="vcard_name" class="form-control select2" style="width: 100%" value="<?php echo e(old('vcard_name')); ?>" autocomplete="vcard_name" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.vcard_audio')); ?></label>
                                                        <input name="vcard_number" class="form-control select2" style="width: 100%" value="<?php echo e(old('vcard_number')); ?>" autocomplete="vcard_number" autofocus>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleMediaSwitch">
                                                    <label class="form-check-label" for="toggleSwitch"><?php echo e(__('messages.attach_media')); ?></label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleMediaSection">
                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_image')); ?></label>
                                                        <input name="image_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('image_attachment_url')); ?>" autocomplete="image_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_video')); ?></label>
                                                        <input name="video_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('video_attachment_url')); ?>" autocomplete="video_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label><?php echo e(__('messages.attach_audio')); ?></label>
                                                        <input name="audio_attachment_url" type="file" class="form-control select2" style="width: 100%" value="<?php echo e(old('audio_attachment_url')); ?>" autocomplete="audio_attachment_url" autofocus>
                                                    </div>
                                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editModalTitleInput = document.getElementById('editItemTitle');
        var editModalIdInput = document.getElementById('editItemId');
        var editModalContentInput = document.getElementById('editItemContent contentTextarea2');
        var editModalVcardNameInput = document.getElementById('editItemVcardName');
        var editModalVcardNumberInput = document.getElementById('editItemVcardNumber');
        var editModalImageAttachmentUrlInput = document.getElementById('editItemImageAttachmentUrl');
        var editModalVideoAttachmentUrlInput = document.getElementById('editItemVideoAttachmentUrl');
        var editModalAudioAttachmentUrlInput = document.getElementById('editItemAudioAttachmentUrl');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var title = button.getAttribute('data-item-title');
                var id = button.getAttribute('data-item-id');
                var content = button.getAttribute('data-item-content');
                var vcard_name = button.getAttribute('data-item-vcard_name');
                var vcard_number = button.getAttribute('data-item-vcard_number');
                var image_attachment_url = button.getAttribute('data-item-image_attachment_url');
                var video_attachment_url = button.getAttribute('data-item-video_attachment_url');
                var audio_attachment_url = button.getAttribute('data-item-audio_attachment_url');

                editModalTitleInput.value = title;
                editModalIdInput.value = id;
                editModalContentInput.value = content;
                editModalVcardNameInput.value = vcard_name;
                editModalVcardNumberInput.value = vcard_number;
                editModalImageAttachmentUrlInput.value = image_attachment_url;
                editModalVideoAttachmentUrlInput.value = video_attachment_url;
                editModalAudioAttachmentUrlInput.value = audio_attachment_url;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.view-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var title = button.getAttribute('data-item-title');
                var content = button.getAttribute('data-item-content');
                var vcard_name = button.getAttribute('data-item-vcard_name');
                var vcard_number = button.getAttribute('data-item-vcard_number');
                var image_attachment_url = button.getAttribute('data-item-image_attachment_url');
                var video_attachment_url = button.getAttribute('data-item-video_attachment_url');
                var audio_attachment_url = button.getAttribute('data-item-audio_attachment_url');

                document.getElementById('modalItemTitle').innerText = title;
                document.getElementById('modalItemContent').innerText = content;
                document.getElementById('modalItemVcard_name').innerText = vcard_name;
                document.getElementById('modalItemVcard_number').innerText = vcard_number;
                document.getElementById('modalItemImage_attachment_url').innerText = image_attachment_url;
                document.getElementById('modalItemVideo_attachment_url').innerText = video_attachment_url;
                document.getElementById('modalItemAudio_attachment_url').innerText = audio_attachment_url;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleSwitch');
        var toggleSection = document.getElementById('toggleSection');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleMediaSwitch');
        var toggleSection = document.getElementById('toggleMediaSection');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
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
        var toggleSwitch = document.getElementById('toggleMediaSwitch2');
        var toggleSection = document.getElementById('toggleMediaSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var tagSelect = document.getElementById('tagSelect');
        var contentTextarea = document.getElementById('contentTextarea');

        tagSelect.addEventListener('change', function() {
            var selectedTag = tagSelect.value;
            var cursorPos = contentTextarea.selectionStart;
            var content = contentTextarea.value;

            var newContent = content.slice(0, cursorPos) + selectedTag + content.slice(cursorPos);

            contentTextarea.value = newContent;
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
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/messaging/message-template.blade.php ENDPATH**/ ?>