<?php $__env->startSection('content'); ?>
<div class="login-wrapper bg-white">
    <div class="intern8">
        <form action="<?php echo e(url('/lang')); ?>" method="GET">
            <?php echo csrf_field(); ?>
            <select name="locale" class="form-control" onchange="this.form.submit()">
                <option value="en" <?php echo e(session()->get('locale') == 'en' ? 'selected' : ''); ?>>English</option>
                <option value="pt" <?php echo e(session()->get('locale') == 'pt' ? 'selected' : ''); ?>>Portuguese</option>
            </select>
        </form>

    </div>
    <div class="row h-100">
        <div class="col-md-6 d-none d-md-flex">
            <div class="overflow-hidden vh-100 w-100">
                <img src="<?php echo e(asset('dist/img/login_bg.jpeg')); ?>" class="w-100">
            </div>
        </div>

        <div class="col-12 col-md-6 my-auto d-flex justify-content-center">

            <div class="login-box">
                <div class="login-logo">
                    <a href="/"><b><?php echo e(config('app.name', $settings->site_name??"")); ?></b></a>
                </div>

                <div class="card shadow-none">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg"><?php echo e(__('Login')); ?> to start your session</p>
                        <form action="/login" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="input-group mb-3"><input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['email'];
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
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="current-password">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                <?php $__errorArgs = ['password'];
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
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>

                                        <label class="form-check-label" for="remember">
                                            <?php echo e(__('messages.remember')); ?>

                                        </label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <?php echo e(__('messages.login')); ?>

                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="mb-1">
                            <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>">
                                <?php echo e(__('messages.forgot')); ?>

                            </a>
                            <?php endif; ?>
                        </p>
                        <p class="mb-0">
                            <a href="/register" class="text-center"><?php echo e(__('messages.register')); ?></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/resources/views/auth/login.blade.php ENDPATH**/ ?>