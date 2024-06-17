<?php $__env->startSection('content'); ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo e(__('messages.whatsapp_menu')); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#"><?php echo e(__('messages.home')); ?></a></li>
                        <li class="breadcrumb-item active"><?php echo e(__('messages.whatsapp_menu')); ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="<?php if($last_session): ?> row <?php else: ?> row justify-content-center <?php endif; ?>">
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        <?php if($last_session): ?> <div class="card-body text-center">
                            <img src="<?php echo e($last_session->qr_code); ?>" id="qr-code-image" class="w-100 mb-5" onload="javascript:(function(){setInterval(function(){document.getElementById('qr-code-image').src=document.getElementById('qr-code-image').src.split('?')[0]+'?time='+new Date().getTime();},3000);}())">
                        </div>
                        <div class="card-footer mt-5">
                            <button class="btn btn-warning" onclick="haveScanned()"><?php echo e(__('messages.i_have_scanned')); ?></button>

                            <div class="mt-4">
                                <small class="text-white"><?php echo e(__('messages.scan_again')); ?></small>
                            </div>
                        </div>

                        <?php else: ?>
                        <div style="height: 300px; display:flex; align-items:center; justify-content: center">
                            <div class="d-block text-center">
                                <div id="loader2"><?php echo e(__('messages.check_authentication')); ?> <span class="spinner-border spinner-border-sm"></span></div>
                                <div id="authenticated" class="text-center"><?php echo e(__('messages.whatsapp_authenticated')); ?></div>
                                <button class="btn btn-primary text-dark fw-bolder" id="disconnect-whatsapp-btn" onclick="disconnect()">
                                    <?php echo e(__('messages.disconnect_whatsapp')); ?>

                                    <span id="loader-disconnect" class="spinner-border spinner-border-sm"></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="loader"> <?php echo e(__('messages.check_whatsapp_authentication_status')); ?> <span class="spinner-border spinner-border-sm"></span></div>
                    <div id="loader-done" style="display: none;"> <?php echo e(__('messages.whatsapp_is_currently_authenticated')); ?></div>

                    <div class="card shadow-none">
                        <div class="table-responsive ">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th> <?php echo e(__('messages.qr_code')); ?></th>
                                        <th><?php echo e(__('messages.last_session')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $whatsapp_session; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $whatsapp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($whatsapp->id); ?></td>
                                        <td><img src="<?php echo e($whatsapp->qr_code); ?>" style="width: 30px;"></td>
                                        <td><?php echo e($whatsapp->created_at); ?></td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php if(count($whatsapp_session) == 0): ?>
                                    <tr>
                                        <td colspan="3" class="text-center text-danger"> <?php echo e(__('messages.no_session_exist')); ?></td>
                                    </tr>
                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', async function() {
        fetchPlans();
    });

    const loader = document.getElementById("loader");
    const loader_done = document.getElementById("loader-done");
    const disconnect_whatsapp_btn = document.getElementById("disconnect-whatsapp-btn");


    const loader2 = document.getElementById("loader2");
    const authenticated = document.getElementById("authenticated");
    loader2.style.display = "none";




    async function fetchPlans() {
        loader.style.display = "block";
        disconnect_whatsapp_btn.style.display = "none";
        authenticated.style.display = "none";
        loader2.style.display = "block";
        const response = await axios.post("<?php echo env('WHATSAPP_API_URI_AUTH'); ?>", {
            userId: <?php echo auth()->user()->id; ?>
        }).then((response) => {
            // Handle the response data
            console.log("response", response);

            disconnect_whatsapp_btn.style.display = "block";
            authenticated.style.display = "block";
            loader2.style.display = "none";
            if (response.data.qrCode) {

                axios.post('/api/whatsapp/save', {
                    qr_code: response.data.qrCode,
                    user_id: '<?php echo auth()->user()->id; ?>'
                }).then(() => {
                    window.location.reload();
                })
            } else {
                loader.style.display = "none";
                disconnect_whatsapp_btn.style.display = "block";
            }

        }, (error) => {
            // Handle errors
            loader.style.display = "none";
            disconnect_whatsapp_btn.style.display = "block";
            authenticated.style.display = "none";
            loader2.style.display = "none";
            console.error('Error during Axios request:', error.message);
        });
    }


    const loaderDist = document.getElementById("loader-disconnect");
    loaderDist.style.display = "none";

    async function disconnect() {

        loaderDist.style.display = "block";

        const response = await axios.post("<?php echo env('WHATSAPP_API_URI_DISCONNECT'); ?>", {
            userId: <?php echo auth()->user()->id; ?>
        }).then((response) => {
            // Handle the response data
            console.log("response", response);

            if (response.data.qrCode) {
                axios.post('/api/whatsapp/save', {
                    qr_code: response.data.qrCode,
                    user_id: '<?php echo auth()->user()->id; ?>'
                }).then(() => {
                    window.location.reload();
                })
            } else {
                loaderDist.style.display = "none";
            }
        }, (error) => {
            // Handle errors
            loaderDist.style.display = "none";
            swal({
                title: "Oops!",
                text: error.message,
                icon: "warning",
                button: "Close",
                className: "custom-button-warning" // Add a custom class to the modal container
            });
            console.error('Error during Axios request:', error.message);
        })
    }


    async function haveScanned() {
        if (confirm('<?php echo __('messages.sure_authenticated'); ?>')) {
            const response = await axios.post("<?php echo env('WHATSAPP_API_VERIFY'); ?>", {
                userId: <?php echo auth()->user()->id; ?>
            }).then((response) => {
                console.log('VERIFY RESPONSE', response)
                if (response.data && response.data.authenticated === true) {
                    window.location.href = "<?php echo route('whatsapp.scanned.status', ['id' => $last_session->id ?? 0]); ?>"
                } else {
                    swal({
                        title: "Oops!",
                        text: "<?php echo __('messages.scanedConfirmation'); ?>. <?php echo __('messages.scan_again_2'); ?>",
                        icon: "warning",
                        button: "Close",
                        className: "custom-button-warning" // Add a custom class to the modal container
                    });
                }

            }, (error) => {
                swal({
                    title: "Oops!",
                    text: error.message,
                    icon: "warning",
                    button: "Close",
                    className: "custom-button-warning" // Add a custom class to the modal container
                });
                console.error('VERIFY Error during Axios request:', error);
            })
        }
    }
</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/whatsapp/index.blade.php ENDPATH**/ ?>