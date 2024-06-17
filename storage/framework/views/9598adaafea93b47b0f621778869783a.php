<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(config('app.name', $settings->site_name??"")); ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">

    <link rel="stylesheet" href="<?php echo e(asset('plugins/fontawesome-free/css/all.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('dist/css/adminlte.min2167.css?v=3.2.0')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('dist/css/style.css')); ?>" />

    <script nonce="4be9ec08-ceb0-43ea-9ed2-fd76eae824c2">
        (function(w, d) {
            ! function(dp, dq, dr, ds) {
                dp[dr] = dp[dr] || {};
                dp[dr].executed = [];
                dp.zaraz = {
                    deferred: [],
                    listeners: []
                };
                dp.zaraz.q = [];
                dp.zaraz._f = function(dt) {
                    return async function() {
                        var du = Array.prototype.slice.call(arguments);
                        dp.zaraz.q.push({
                            m: dt,
                            a: du
                        })
                    }
                };
                for (const dv of ["track", "set", "debug"]) dp.zaraz[dv] = dp.zaraz._f(dv);
                dp.zaraz.init = () => {
                    var dw = dq.getElementsByTagName(ds)[0],
                        dx = dq.createElement(ds),
                        dy = dq.getElementsByTagName("title")[0];
                    dy && (dp[dr].t = dq.getElementsByTagName("title")[0].text);
                    dp[dr].x = Math.random();
                    dp[dr].w = dp.screen.width;
                    dp[dr].h = dp.screen.height;
                    dp[dr].j = dp.innerHeight;
                    dp[dr].e = dp.innerWidth;
                    dp[dr].l = dp.location.href;
                    dp[dr].r = dq.referrer;
                    dp[dr].k = dp.screen.colorDepth;
                    dp[dr].n = dq.characterSet;
                    dp[dr].o = (new Date).getTimezoneOffset();
                    if (dp.dataLayer)
                        for (const dC of Object.entries(Object.entries(dataLayer).reduce(((dD, dE) => ({
                                ...dD[1],
                                ...dE[1]
                            })), {}))) zaraz.set(dC[0], dC[1], {
                            scope: "page"
                        });
                    dp[dr].q = [];
                    for (; dp.zaraz.q.length;) {
                        const dF = dp.zaraz.q.shift();
                        dp[dr].q.push(dF)
                    }
                    dx.defer = !0;
                    for (const dG of [localStorage, sessionStorage]) Object.keys(dG || {}).filter((dI => dI.startsWith("_zaraz_"))).forEach((dH => {
                        try {
                            dp[dr]["z_" + dH.slice(7)] = JSON.parse(dG.getItem(dH))
                        } catch {
                            dp[dr]["z_" + dH.slice(7)] = dG.getItem(dH)
                        }
                    }));
                    dx.referrerPolicy = "origin";
                    dx.src = "https://adminlte.io/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(dp[dr])));
                    dw.parentNode.insertBefore(dx, dw)
                };
                ["complete", "interactive"].includes(dq.readyState) ? zaraz.init() : dp.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>

    <style>
        .login-wrapper {
            position: relative;
        }

        @media (min-width: 600px) {
            .intern8 {
                position: absolute;
                top: 10px;
                right: 40px;
                z-index: 17;
            }
        }

        @media (max-width: 600px) {
            .intern8 {
                position: absolute;
                top: 20px;
                right: 0;
                z-index: 17;
                width: 90px;
                margin-right: 10px;
                float: right;
            }
        }
    </style>

</head>

<body class="hold-transition">
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>


    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>

    <script src="<?php echo e(asset('dist/js/adminlte.min2167.js?v=3.2.0')); ?>"></script>

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
</body>

</html><?php /**PATH /var/www/html/laravel/resources/views/layouts/app-auth.blade.php ENDPATH**/ ?>