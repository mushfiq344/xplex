<?php $__env->startSection('head_js'); ?>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <?php if(session('alert')): ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <?php echo e(session('alert')); ?>

        </div>
    <?php endif; ?>
    <div class="tab sticky-top">
        <a href="<?php echo e(url('dashboard_movie')); ?>">
            <button class="tablinks">Movies</button>
        </a>
        <a href="<?php echo e(url('dashboard_tv_show')); ?>">
            <button class="tablinks">TV Shows</button>
        </a>
        <a href="<?php echo e(url('dashboard_explore')); ?>">
            <button class="tablinks active">Explore</button>
        </a>
        <?php if(Session::get('admin_type')=='admin'): ?>
            <a href="<?php echo e(url('dashboard_game')); ?>">
                <button class="tablinks">Games</button>
            </a>

            <a href="<?php echo e(url('dashboard_reset_password')); ?>">
                <button class="tablinks">Reset Password
                </button>
            </a>
            <a href="<?php echo e(url('/dashboard_backup')); ?>">
                <button class="tablinks">Scan
                </button>
            </a>
            <a href="<?php echo e(url('/dashboard_users')); ?>">
                <button class="tablinks">Users
                </button>
            </a>
            <a href="<?php echo e(url('dashboard_ads')); ?>">
                <button class="tablinks">Ads</button>
            </a>
        <?php endif; ?>
    </div>
    <div id="Explore" class="tabcontent" style="display:block;">
        <!--/////////////////////////////////////////-->
        <div class='container' style="margin-top: 30px">
            <div class="row">
                <?php if(Session::get('admin_type')=='admin'): ?>
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="<?php echo e(url('show_movies')); ?>">Show Movies</a>
                    </div>
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="<?php echo e(url('show_tv_shows')); ?>">Show Tv Shows</a>
                    </div>
                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="<?php echo e(url('show_pc_games')); ?>">Show Pc Games</a>
                    </div>

                    <div class="col-md-4 mt-4">
                        <a style="width:80%" class="btn btn-success" href="<?php echo e(url('show_ads')); ?>">Advertisements</a>
                    </div>
                <?php endif; ?>
                <div class="col-md-4 mt-4">
                    <a style="width:80%" class="btn btn-success" href="<?php echo e(url('show_requested_movies')); ?>">Approve
                        Movies</a>
                </div>

            </div>
            <br>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>