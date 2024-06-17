<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title"><?php echo e(__('messages.billing')); ?></h3>
                </div>
                <div class="col-md-2 text-end">

                    <div class="btn-group">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                            Filter
                        </button>
                        <div class="dropdown-menu dropdown-menu-start dropdown-menu-lg-start shadow-sm border-0" aria-labelledby="dropdownMenuClickableOutside" style="width:300px">
                            <form method="POST" action="<?php echo e(route('billing.filter')); ?>">
                                <?php echo csrf_field(); ?>

                                <div class="dropdown-item">
                                    <label>Delivery mode</label>
                                    <select class="form-control" name="delivery_mode">
                                        <option value="NULL">--select--</option>
                                        <option value="1">Automatic</option>
                                        <option value="0">Manually</option>
                                    </select>
                                </div>

                                <div class="dropdown-item">
                                    <div class="form-group">
                                        <label><?php echo e(__('messages.server')); ?></label>
                                        <select name="server" id="server" class="form-control select2  <?php $__errorArgs = ['server'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="server" autofocus>
                                            <option value="NULL">--<?php echo e(__('messages.select_server')); ?>--</option>
                                            <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($server->id); ?>"><?php echo e($server->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['server'];
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

                                <div class="dropdown-item">
                                    <div class="form-group">
                                        <label><?php echo e(__('messages.device')); ?></label>
                                        <select name="device_id" id="device_id" class="form-control select2  <?php $__errorArgs = ['device_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="device_id" autofocus>
                                            <option value="NULL">--<?php echo e(__('messages.select_device')); ?>--</option>
                                            <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($device->id); ?>"><?php echo e($device->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['device_id'];
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

                                <div class="dropdown-item">
                                    <div class="form-group">
                                        <label><?php echo e(__('messages.application')); ?></label>
                                        <select name="application_id" id="application_id" class="form-control select2  <?php $__errorArgs = ['application_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="application_id" autofocus>
                                            <option value="NULL">--<?php echo e(__('messages.select_application')); ?>--</option>
                                            <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($app->id); ?>"><?php echo e($app->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php $__errorArgs = ['application_id'];
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

                                <div class="dropdown-item">
                                    <label>Sending days</label>
                                    <select class="form-control" name="sending_days">
                                        <option value="NULL">--select--</option>
                                        <option value="daily">Daily</option>
                                        <option value="sunday">Sunday</option>
                                        <option value="monday">Monday</option>
                                        <option value="tuesday">Tuesday</option>
                                        <option value="wednesday">Wednesday</option>
                                        <option value="thursday">Thursday</option>
                                        <option value="friday">Friday</option>
                                        <option value="saturday">Saturday</option>
                                    </select>
                                </div>

                                <div class="dropdown-item">
                                    <button type="submit" class="btn btn-dark w-100">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?php echo e(__('messages.create_new_bill')); ?>

                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <?php if(COUNT($billings)===0): ?> <div class="text-center mt-5">No bill found </div> <?php endif; ?>
            <div class="row">
                <?php $__currentLoopData = $billings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-1 shadow-sm">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    <div class="fs-6"><?php echo e($bill->title); ?> </div>
                                    <div style="font-size:.7rem"><?php if($bill->automatic_sending===1): ?> Automatic <?php else: ?> Manual <?php endif; ?></div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check form-switch">
                                        <input name="thursday_billing" value="1" class="form-check-input" type="checkbox" title="automatic sending" id="thursdayBilling" onchange="automaticSending(<?php echo e($bill['id']); ?>, <?php echo e($bill['automatic_sending']); ?>)" <?php if($bill->automatic_sending): ?> checked <?php endif; ?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-6">
                                    <a href="<?php echo e(route('billing.history', ['id'=> $bill->id])); ?>" class="text-dark"> <span class="bg-dark me-1 rounded" style="padding:3.7px 3.7px; width:20px; font-size: 7px"><i class="fa fa-terminal"></i></span><?php echo e($bill->customer_received_count); ?></a>
                                </div>
                                <div class="col-6 text-end">
                                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                    </svg><?php echo e($bill->customer_count); ?>

                                </div>

                                <div class="col-12 mt-2 overflow-hidden">
                                    <?php if($bill->get_server): ?> <span class="me-1"><i class="fa fa-server me-1"></i></span> <?php echo e($bill->get_server->name); ?> <?php endif; ?>
                                </div>
                                <div class="col-12 mt-2 overflow-hidden">
                                    <span class="me-1"><i class="fa fa-comment me-1"></i></span> <?php echo e($bill->get_message_template->title); ?>

                                </div>
                                <div class="col-12 mt-2 overflow-hidden">
                                    <span class="me-1"><i class="fa fa-clock"></i></span> <?php echo e(\Carbon\Carbon::parse( $bill->created_at )->format('d/m/Y H:i:s')); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md">
                                    <a href="<?php echo e(route('messaging.alert.send', ['id'=>$bill->id])); ?>" onclick="return confirm('Are you sure you want to send this bill?')">
                                        <button class="btn btn-sm btn-warning edit-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                            </svg>
                                            <?php echo e(__('messages.send')); ?>

                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-secondary edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="<?php echo e($bill->id); ?>" data-application="<?php echo e($bill->application_id); ?>" data-title="<?php echo e($bill->title); ?>" data-device="<?php echo e($bill->device_id); ?>" data-server="<?php echo e($bill->server); ?>" data-default-message="<?php echo e($bill->default_message); ?>" data-shipping-time="<?php echo e($bill->shipping_time); ?>" data-automatic-billing="<?php echo e($bill->automatic_billing); ?>" data-days-to-expire="<?php echo e($bill->days_to_expire); ?>" data-sending-interval="<?php echo e($bill->shipping_interval); ?>" data-customer-subscription-situation="<?php echo e($bill->customer_subscription_status); ?>" data-monday-billing="<?php echo e($bill->monday_billing); ?>" data-tuesday-billing="<?php echo e($bill->tuesday_billing); ?>" data-wednesday-billing="<?php echo e($bill->wednesday_billing); ?>" data-thursday-billing="<?php echo e($bill->thursday_billing); ?>" data-friday-billing="<?php echo e($bill->friday_billing); ?>" data-saturday-billing="<?php echo e($bill->saturday_billing); ?>" data-daily-billing="<?php echo e($bill->daily_billing); ?>" data-sunday-billing="<?php echo e($bill->sunday_billing); ?>" SELECT `id`, ``, `automatic_sending`, `automatic_billing`, `sunday_billing`, `daily_billing`, `monday_billing`, `tuesday_billing`, `wednesday_billing`, `thursday_billing`, `friday_billing`, `saturday_billing`, `shipping_time`, `default_message`, `server`, `application_id`, `device_id`, `customer_referal_id`, `customer_subscription_status`, `days_to_expire`, `shipping_interval`, `last_shipment`, `customer_count`, `customer_received_count`>
                                        <i class="fa fa-edit"></i> <?php echo e(__('messages.edit')); ?>

                                    </button>
                                    <a href="<?php echo e(route('billing.destroy', ['id'=>$bill->id])); ?>" onclick="return confirm('Are you sure you want to delete this item?')">
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
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('messages.create_new_bill')); ?> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="<?php echo e(route('billing.store')); ?>" enctype="multipart/form-data">
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




                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-configure-tab" data-bs-toggle="pill" data-bs-target="#pills-configure" type="button" role="tab" aria-controls="pills-configure" aria-selected="true"><?php echo e(__('messages.configure')); ?></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-automatic-tab" data-bs-toggle="pill" data-bs-target="#pills-automatic" type="button" role="tab" aria-controls="pills-automatic" aria-selected="false"><?php echo e(__('messages.automatic')); ?></button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-configure" role="tabpanel" aria-labelledby="pills-configure-tab">

                                <div class="form-group">
                                    <label><?php echo e(__('messages.title')); ?></label>
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
                                    <label><?php echo e(__('messages.message')); ?></label>
                                    <select name="default_message" id="tagSelect" class="form-control select2  <?php $__errorArgs = ['default_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="default_message" autofocus>
                                        <option value="">--<?php echo e(__('messages.select_message')); ?>--</option>
                                        <?php $__currentLoopData = $message_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTemp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($msgTemp->id); ?>"><?php echo e($msgTemp->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['default_message'];
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
                                    <label><?php echo e(__('messages.server')); ?></label>
                                    <select name="server" id="server" class="form-control select2  <?php $__errorArgs = ['server'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="server" autofocus>
                                        <option value="">--<?php echo e(__('messages.select_server')); ?>--</option>
                                        <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($server->id); ?>"><?php echo e($server->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['server'];
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
                                    <label><?php echo e(__('messages.device')); ?></label>
                                    <select name="device_id" id="device_id" class="form-control select2  <?php $__errorArgs = ['device_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="device_id" autofocus>
                                        <option value="">--<?php echo e(__('messages.select_device')); ?>--</option>
                                        <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($device->id); ?>"><?php echo e($device->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['device_id'];
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
                                    <label><?php echo e(__('messages.application')); ?></label>
                                    <select name="application_id" id="application_id" class="form-control select2  <?php $__errorArgs = ['application_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="application_id" autofocus>
                                        <option value="">--<?php echo e(__('messages.select_application')); ?>--</option>
                                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($app->id); ?>"><?php echo e($app->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['application_id'];
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('messages.customer_subscription_situation')); ?></label>
                                            <select name="customer_subscription_status" id="customer_subscription_status" class="form-control select2  <?php $__errorArgs = ['customer_subscription_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="customer_subscription_status" autofocus>
                                                <option>--<?php echo e(__('messages.select_option')); ?>--</option>
                                                <option value="all_client"><?php echo e(__('messages.all_client')); ?></option>
                                                <option value="active"><?php echo e(__('messages.active')); ?></option>
                                                <option value="in_active"><?php echo e(__('messages.inactive')); ?></option>
                                                <option value="already_due"><?php echo e(__('messages.already_due')); ?></option>
                                                <option value="due_today"><?php echo e(__('messages.due_today')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['customer_subscription_status'];
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('messages.sending_interval')); ?></label>
                                            <input type="number" name="shipping_interval" class="form-control select2  <?php $__errorArgs = ['shipping_interval'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('shipping_interval')); ?>" autocomplete="shipping_interval" autofocus>

                                            <?php $__errorArgs = ['shipping_interval'];
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

                                <div class="form-group">
                                    <label><?php echo e(__('messages.difference_in_days')); ?></label>
                                    <input type="number" name="days_to_expire" class="form-control select2  <?php $__errorArgs = ['days_to_expire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('days_to_expire')); ?>" autocomplete="days_to_expire" autofocus>

                                    <?php $__errorArgs = ['days_to_expire'];
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
                                <!-- To learn more about how to create a charge you can click here to see the tutorial with examples of the most used charges -->
                            </div>
                            <div class="tab-pane fade" id="pills-automatic" role="tabpanel" aria-labelledby="pills-automatic-tab">

                                <div class="form-check form-switch">
                                    <input name="automatic_billing" value="1" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault"><?php echo e(__('messages.authomatic_billing')); ?>

                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label><?php echo e(__('messages.shipping_time')); ?></label>
                                    <input type="time" name="shipping_time" class="form-control select2  <?php $__errorArgs = ['shipping_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('shipping_time')); ?>" autocomplete="shipping_time" autofocus>

                                    <?php $__errorArgs = ['shipping_time'];
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

                                <div class="row mt-3">
                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="daily_billing" value="1" class="form-check-input" type="checkbox" id="dailyBilling">
                                            <label class="form-check-label" for="dailyBilling"><?php echo e(__('messages.daily_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="sunday_billing" value="1" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling"><?php echo e(__('messages.sunday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="monday_billing" value="1" class="form-check-input" type="checkbox" id="mondayBilling">
                                            <label class="form-check-label" for="mondayBilling"><?php echo e(__('messages.monday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="tuesday_billing" value="1" class="form-check-input" type="checkbox" id="tuesdayBilling">
                                            <label class="form-check-label" for="tuesdayBilling"><?php echo e(__('messages.tuesday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="wednesday_billing" value="1" class="form-check-input" type="checkbox" id="wednesdayBilling">
                                            <label class="form-check-label" for="wednesdayBilling"><?php echo e(__('messages.wednesday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="thursday_billing" value="1" class="form-check-input" type="checkbox" id="thursdayBilling">
                                            <label class="form-check-label" for="thursdayBilling"><?php echo e(__('messages.thursday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="friday_billing" value="1" class="form-check-input" type="checkbox" id="fridayBilling">
                                            <label class="form-check-label" for="fridayBilling"><?php echo e(__('messages.friday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="saturday_billing" value="1" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling">saturday_billing
                                            </label>
                                        </div>
                                    </div>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel"><?php echo e(__('messages.edit_billing')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="<?php echo e(route('billing.update')); ?>" enctype="multipart/form-data">

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
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-configure2-tab" data-bs-toggle="pill" data-bs-target="#pills-configure2" type="button" role="tab" aria-controls="pills-configure2" aria-selected="true"><?php echo e(__('messages.configure')); ?></button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-automatic2-tab" data-bs-toggle="pill" data-bs-target="#pills-automatic2" type="button" role="tab" aria-controls="pills-automatic2" aria-selected="false"><?php echo e(__('messages.automatic')); ?></button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-configure2" role="tabpanel" aria-labelledby="pills-configure2-tab">
                                <input name="id" id="editId" type="hidden">
                                <div class="form-group">
                                    <label><?php echo e(__('messages.title')); ?></label>
                                    <input name="title" id="editTitle" class="form-control select2  <?php $__errorArgs = ['title'];
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
                                    <label><?php echo e(__('messages.message')); ?></label>
                                    <select name="default_message" id="editDefaultMessage" class="form-control select2  <?php $__errorArgs = ['default_message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="default_message" autofocus>
                                        <option value="">--<?php echo e(__('messages.stream_select_message')); ?>--</option>
                                        <?php $__currentLoopData = $message_templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msgTemp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($msgTemp->id); ?>"><?php echo e($msgTemp->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['default_message'];
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
                                    <label><?php echo e(__('messages.server')); ?></label>
                                    <select name="server" id="editServer" class="form-control select2  <?php $__errorArgs = ['server'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="server" autofocus>
                                        <option>--<?php echo e(__('messages.select_server')); ?>--</option>
                                        <?php $__currentLoopData = $servers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($server->id); ?>"><?php echo e($server->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['server'];
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
                                    <label><?php echo e(__('messages.device')); ?></label>
                                    <select name="device_id" id="editDevice" class="form-control select2  <?php $__errorArgs = ['device_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="device_id" autofocus>
                                        <option>--<?php echo e(__('messages.select_device')); ?>--</option>
                                        <?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($device->id); ?>"><?php echo e($device->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['device_id'];
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
                                    <label><?php echo e(__('messages.application')); ?></label>
                                    <select name="application_id" id="editApplication" class="form-control select2  <?php $__errorArgs = ['application_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="application_id" autofocus>
                                        <option>--<?php echo e(__('messages.select_application')); ?>--</option>
                                        <?php $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($app->id); ?>"><?php echo e($app->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['application_id'];
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
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('messages.customer_subscription_situation')); ?></label>
                                            <select name="customer_subscription_status" id="editCustomerSubscriptionSituation" class="form-control select2  <?php $__errorArgs = ['customer_subscription_status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" autocomplete="customer_subscription_status" autofocus>
                                                <option>--<?php echo e(__('messages.select_option')); ?>--</option>
                                                <option value="all_client"><?php echo e(__('messages.all_client')); ?></option>
                                                <option value="active"><?php echo e(__('messages.active')); ?></option>
                                                <option value="in_active"><?php echo e(__('messages.inactive')); ?></option>
                                                <option value="already_due"><?php echo e(__('messages.already_due')); ?></option>
                                                <option value="due_today"><?php echo e(__('messages.due_today')); ?></option>
                                            </select>
                                            <?php $__errorArgs = ['customer_subscription_status'];
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
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label><?php echo e(__('messages.sending_interval')); ?></label>
                                            <input type="number" name="shipping_interval" id="editSendingInterval" class="form-control select2  <?php $__errorArgs = ['shipping_interval'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('shipping_interval')); ?>" autocomplete="shipping_interval" autofocus>

                                            <?php $__errorArgs = ['shipping_interval'];
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

                                <div class="form-group">
                                    <label><?php echo e(__('messages.difference_in_days')); ?></label>
                                    <input type="number" name="days_to_expire" id="editDaysToExpire" class="form-control select2  <?php $__errorArgs = ['days_to_expire'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('days_to_expire')); ?>" autocomplete="days_to_expire" autofocus>

                                    <?php $__errorArgs = ['days_to_expire'];
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
                                <!-- To learn more about how to create a charge you can click here to see the tutorial with examples of the most used charges -->
                            </div>
                            <div class="tab-pane fade" id="pills-automatic2" role="tabpanel" aria-labelledby="pills-automatic2-tab">

                                <div class="form-check form-switch">
                                    <input name="automatic_billing" value="1" id="editAutomaticBilling" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="editAutomaticBilling"><?php echo e(__('messages.authomatic_billing')); ?>

                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label><?php echo e(__('messages.shipping_time')); ?></label>
                                    <input type="time" name="shipping_time" id="editShippingTime" class="form-control select2  <?php $__errorArgs = ['shipping_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" style="width: 100%" value="<?php echo e(old('shipping_time')); ?>" autocomplete="shipping_time" autofocus>

                                    <?php $__errorArgs = ['shipping_time'];
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

                                <div class="row mt-3">
                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="daily_billing" value="1" id="editDailyBilling" class="form-check-input" type="checkbox" id="dailyBilling">
                                            <label class="form-check-label" for="dailyBilling"><?php echo e(__('messages.daily_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="sunday_billing" value="1" id="editSundayBilling" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling"><?php echo e(__('messages.sunday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="monday_billing" value="1" id="editMondayBilling" class="form-check-input" type="checkbox" id="mondayBilling">
                                            <label class="form-check-label" for="mondayBilling"><?php echo e(__('messages.monday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="tuesday_billing" value="1" id="editTuesdayBilling" class="form-check-input" type="checkbox" id="tuesdayBilling">
                                            <label class="form-check-label" for="tuesdayBilling"><?php echo e(__('messages.tuesday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="wednesday_billing" value="1" id="editWednesdayBilling" class="form-check-input" type="checkbox" id="wednesdayBilling">
                                            <label class="form-check-label" for="wednesdayBilling"><?php echo e(__('messages.wednesday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="thursday_billing" value="1" id="editThursdayBilling" class="form-check-input" type="checkbox" id="thursdayBilling">
                                            <label class="form-check-label" for="thursdayBilling"><?php echo e(__('messages.thursday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="friday_billing" value="1" id="editFridayBilling" class="form-check-input" type="checkbox" id="fridayBilling">
                                            <label class="form-check-label" for="fridayBilling"><?php echo e(__('messages.friday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="saturday_billing" value="1" id="editSaturdayBilling" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling"><?php echo e(__('messages.saturday_billing')); ?>

                                            </label>
                                        </div>
                                    </div>
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
</div>


<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editId = document.getElementById('editId');
        var editTitle = document.getElementById('editTitle');
        var editApplication = document.getElementById('editApplication');
        var editDevice = document.getElementById('editDevice');
        var editServer = document.getElementById('editServer');
        var editDefaultMessage = document.getElementById('editDefaultMessage');
        var editShippingTime = document.getElementById('editShippingTime');
        var editAutomaticBilling = document.getElementById('editAutomaticBilling');
        var editDaysToExpire = document.getElementById('editDaysToExpire');
        var editSendingInterval = document.getElementById('editSendingInterval');
        var editCustomerSubscriptionSituation = document.getElementById('editCustomerSubscriptionSituation');
        var editMondayBilling = document.getElementById('editMondayBilling');
        var editSundayBilling = document.getElementById('editSundayBilling');
        var editTuesdayBilling = document.getElementById('editTuesdayBilling');
        var editWednesdayBilling = document.getElementById('editWednesdayBilling');
        var editThursdayBilling = document.getElementById('editThursdayBilling');
        var editFridayBilling = document.getElementById('editFridayBilling');
        var editSaturdayBilling = document.getElementById('editSaturdayBilling');
        var editDailyBilling = document.getElementById('editDailyBilling');





        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                editId.value = button.getAttribute('data-id');
                editTitle.value = button.getAttribute('data-title');
                editApplication.value = button.getAttribute('data-application');
                editDevice.value = button.getAttribute('data-device');
                editServer.value = button.getAttribute('data-server');
                editDefaultMessage.value = button.getAttribute('data-default-message');
                editShippingTime.value = button.getAttribute('data-shipping-time');
                editAutomaticBilling.checked = Number(button.getAttribute('data-automatic-billing')) === 1 ? true : false;
                editDaysToExpire.value = button.getAttribute('data-days-to-expire');
                editSendingInterval.value = button.getAttribute('data-sending-interval');
                editCustomerSubscriptionSituation.value = button.getAttribute('data-customer-subscription-situation');
                editMondayBilling.checked = parseInt(button.getAttribute('data-monday-billing')) === 1 ? true : false;
                editSundayBilling.checked = parseInt(button.getAttribute('data-sunday-billing')) === 1 ? true : false;
                editTuesdayBilling.checked = parseInt(button.getAttribute('data-tuesday-billing')) === 1 ? true : false;
                editWednesdayBilling.checked = parseInt(button.getAttribute('data-wednesday-billing')) === 1 ? true : false;
                editThursdayBilling.checked = parseInt(button.getAttribute('data-thursday-billing')) === 1 ? true : false;
                editFridayBilling.checked = parseInt(button.getAttribute('data-friday-billing')) === 1 ? true : false;
                editSaturdayBilling.checked = parseInt(button.getAttribute('data-saturday-billing')) === 1 ? true : false;
                editDailyBilling.checked = parseInt(button.getAttribute('data-daily-billing')) === 1 ? true : false;

            });
        });
    });

    async function automaticSending(id, value) {

        await fetch(`/api/billing/sedingmode/${id}/${value==0?1:0}`)
            .then(response => {
                // Check if the request was successful (status code 200)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return response.json();
            })
            .then(data => {

                console.log(data);
                window.location.reload();
            })
            .catch(error => {
                // Handle errors
                alert(error.message)
                console.error('Error during fetch operation:', error);
            });
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/billings/index.blade.php ENDPATH**/ ?>