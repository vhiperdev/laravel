<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', $settings->site_name??"")); ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>" />

    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/jqvmap/jqvmap.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min2167.css?v=3.2.0')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/daterangepicker/daterangepicker.css')); ?>" />

    <link rel="stylesheet" href="<?php echo e(asset('plugins/summernote/summernote-bs4.min.css')); ?>" />
    <?php echo $__env->yieldPushContent('header-includes'); ?>


    <link rel="stylesheet" href="<?php echo e(asset('dist/css/style.css')); ?>" />
    <!-- Scripts -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>

    <style>
        .d-link {
            text-decoration: none !important;
        }

        .custom-button .swal-footer {
            text-align: center;
        }

        .custom-button .swal-footer .swal-button {
            background-color: #14A44D;
        }

        .custom-button-warning .swal-footer {
            text-align: center;
        }

        .custom-button-warning .swal-footer .swal-button {
            background-color: #dc3545;
        }

        a {
            text-decoration: none;
        }

        .nav-sidebar {
            position: relative;
            overflow-x: hidden;
        }

        .fixToButtom {
            position: fixed;
            bottom: 10px;
            left: 0;
            width: auto;
            height: 40px;
            background-color: #E4A11B;
            display: flex;
            justify-content: center;
            align-items: center;
            border-top-right-radius: 20px;
            border-bottom-right-radius: 20px;

        }

        .fixToButtom p,
        .fixToButtom i {
            font-weight: 900 !important;
            font-size: .9rem;
            color: black;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="app" class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo e(asset($settings->site_logo)); ?>" alt="AdminLTELogo" height="60" width="60" />
        </div>

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="/" class="brand-link d-link">
                <img src="<?php echo e(asset($settings->site_logo)); ?>" alt="<?php echo e($settings->site_name); ?>" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
                <span class="brand-text font-weight-light d-link"> <?php if($settings->site_name): ?><?php echo e($settings->site_name); ?> <?php else: ?> <?php echo e(config('app.name')); ?> <?php endif; ?></span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo e(asset('/dist/img/avatar.png')); ?>" class="img-circle elevation-2" alt="User Image" />
                    </div>
                    <div class="info">
                        <a href="<?php echo e(route('profile')); ?>" class="d-block d-link"> <?php echo e(Auth::user()->name); ?></a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="/home" class="nav-link <?php echo e((\Request::route()->getName() == 'home') ? 'active' : ''); ?>">
                                <i class="fa fa-home nav-icon"></i>
                                <p><?php echo e(__('messages.dashboard')); ?></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link <?php echo e((\Request::route()->getName() == 'customers') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    <?php echo e(__('messages.customers')); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('customers')); ?>" class="nav-link">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p><?php echo e(__('messages.all_customers')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('customers.create')); ?>" class="nav-link">
                                        <i class="far fa-edit nav-icon"></i>
                                        <p><?php echo e(__('messages.create_customers')); ?></p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('plans')); ?>" class="nav-link <?php echo e((\Request::route()->getName() == 'plans') ? 'active' : ''); ?>">
                                <i class="fa fa-suitcase nav-icon"></i>
                                <p><?php echo e(__('messages.plans')); ?></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo e(route('reseller.plans')); ?>" class="nav-link <?php echo e((\Request::route()->getName() == 'reseller.plans') ? 'active' : ''); ?>">
                                <i class="fa fa-suitcase nav-icon"></i>
                                <p><?php echo e(__('messages.resellerplans')); ?></p>
                            </a>
                        </li>


                        <?php if(Auth()->user()->hasRole('admin')): ?>
                        <li class="nav-item">
                            <a href="<?php echo e(route('reseller')); ?>" class="nav-link <?php echo e((\Request::route()->getName() == 'reseller') ? 'active' : ''); ?>">
                                <i class="fa fa-users nav-icon"></i>
                                <p><?php echo e(__('messages.resellers')); ?></p>
                            </a>
                        </li>
                        <?php endif; ?>



                        <li class="nav-item">
                            <a href="<?php echo e(route('products')); ?>" class="nav-link <?php echo e((\Request::route()->getName() == 'products') ? 'active' : ''); ?>">
                                <i class="fa fa-cube nav-icon"></i>
                                <p><?php echo e(__('messages.products')); ?></p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link <?php echo e((\Request::route()->getName() == 'subscriptions') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    <?php echo e(__('messages.subscriptions')); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('subscriptions')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>All Subscriptions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('subscriptions.active')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Active Subscriptions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('subscriptions.inactive')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inactive Subscriptions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('subscriptions.due_this_month')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Due This Month</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('subscriptions.over_due')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Over due</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php echo e((\Request::route()->getName() == 'messaging') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-comment"></i>
                                <p>
                                    <?php echo e(__('messages.messaging')); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('messaging.template')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Message Template</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo e(route('whatsapp')); ?>" class="nav-link <?php echo e((\Request::route()->getName() == 'whatsapp') ? 'active' : ''); ?>">
                                <i class="nav-icon fab fa-whatsapp"></i>
                                <p>
                                    <?php echo e(__('messages.whatsapp_menu')); ?>

                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link <?php echo e((\Request::route()->getName() == 'billing') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    <?php echo e(__('messages.billing')); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo e(route('billing.configure')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Configure Billing</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link <?php echo e((\Request::route()->getName() == 'settings') ? 'active' : ''); ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    <?php echo e(__('messages.system_settings')); ?>

                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <?php if(Auth()->user()->hasRole('admin')): ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('settings')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>General Setting</p>
                                    </a>
                                </li>

                                <?php endif; ?>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('servers')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo e(__('messages.server')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('applications')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo e(__('messages.application')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('devices')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p><?php echo e(__('messages.device')); ?></p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo e(route('customer_referal')); ?>" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customer Referals</p>
                                    </a>
                                </li>
                            </ul>
                        </li>



                        <li class="nav-item">
                            <a href="#" class="nav-link text-warning" onclick="logoutConfirmation()">
                                <i class="fa fa-key nav-icon"></i>
                                <p><?php echo e(__('messages.logout')); ?></p>
                            </a>
                        </li>
                        <?php if(auth()->user()->hasRole('reseller')): ?>
                        <li class="nav-item fixToButtom">
                            <a href="#" class="nav-link text-warning">
                                <i class="fa fa-clock nav-icon"></i>
                                <p>
                                    <?php echo e(__('messages.expiry_date')); ?>: <?php echo e(Carbon\Carbon::parse(\App\Models\ResellerPlanSubscription::where('reseller_id', auth()->user()->id)->orderBy('id', 'DESC')->first()->next_due_date)->toTimeAgo()); ?>

                                </p>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </aside>
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>


        <footer class="main-footer">
            <strong>Copyright &copy; 2024
                <a href="#" class="text-warning">appname.com</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 0.0.1
            </div>
        </footer>

        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>



    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>

    <script>
        $.widget.bridge("uibutton", $.ui.button);
    </script>

    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/chart.js/Chart.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/sparklines/sparkline.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/moment/moment.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/daterangepicker/daterangepicker.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/summernote/summernote-bs4.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>

    <script src="<?php echo e(asset('dist/js/adminlte2167.js?v=3.2.0')); ?>"></script>

    <script src="<?php echo e(asset('dist/js/demo.js')); ?>"></script>

    <script src="<?php echo e(asset('dist/js/pages/dashboard.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php if(Session::has('message')): ?>
    <script>
        toastr.success("<?php echo Session::get('message'); ?>")
    </script>
    <?php endif; ?>

    <?php if(Session::has('message')): ?>
    <script>
        swal({
            title: "Succesful",
            text: "<?php echo Session::get('message'); ?>",
            icon: "success",
            button: "Ok",
            className: "custom-button" // Add a custom class to the modal container
        });
    </script>
    <?php endif; ?>



    <?php if(Session::has('error')): ?>
    <script>
        swal({
            title: "Oops!",
            text: "<?php echo Session::get('error'); ?>",
            icon: "warning",
            button: "Close",
            className: "custom-button-warning" // Add a custom class to the modal container
        });
    </script>
    <?php endif; ?>

    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
        <?php echo csrf_field(); ?>
    </form>

    <script>
        function logoutConfirmation() {
            swal({
                title: "<?php echo __('messages.are_you_sure'); ?>",
                text: "<?php echo __('messages.you_will_be_logged_out'); ?>",
                icon: "warning",
                button: "<?php echo __('messages.ok'); ?>",
                className: "custom-button-warning" // Add a custom class to the modal container
            }).then((response) => {
                if (response === true) {
                    document.getElementById('logout-form').submit();
                }
            })



        }
    </script>
</body>

</html><?php /**PATH /var/www/html/laravel/resources/views/layouts/app.blade.php ENDPATH**/ ?>