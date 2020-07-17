<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <?php if(session('alert')): ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo e(session('alert')); ?>

                </div>
                <?php endif; ?>
                <div class="card-body">
                    <form method="POST" action="<?php echo e(url('login')); ?>">
                        <?php echo csrf_field(); ?>
                        <h1>Username:</h1>
                        <input placeholder="Enter Username" class="form-control" name="username" required>
                        <h1>Password:</h1>
                        <input  type="password" id="password" class="form-control"  name="password" value="" required>
                        <br>
                        <input class="btn btn-primary col-md-12"  type = 'submit' value = "Login"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>