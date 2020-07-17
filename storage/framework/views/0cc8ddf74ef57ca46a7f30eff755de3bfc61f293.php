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
            <button class="tablinks active">TV Shows</button>
        </a>
        <a href="<?php echo e(url('dashboard_explore')); ?>">
            <button class="tablinks">Explore</button>
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
    <div id="TV Shows" class="tabcontent" style="display:block;">
        <!-- loader for tv_show    -->
        <div style="display: flex;margin-top: 30px">
            <div class="extra"> Enter the imDB url : <input type="text" id="search_tv_show"
                                                            placeholder="Enter imdb link here"></div>
            <div id="spin_tv_show" class="loader" style="display: none"></div>
        </div>
        <br>
        <!-- loader for movie    -->
        <form action="<?php echo e(url('insert_tv_show')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input id="imdb_id_tv_show" type="text" name="imdb_id_tv_show" value="N/A" style="display: none">
            <h4>Title:</h4>
            <input type="text" id="title_tv_show"
                   class="form-control<?php echo e($errors->has('title_tv_show') ? ' is-invalid' : ''); ?>"
                   name="title_tv_show" value="" placeholder="Enter title here" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Release Date:</h4>
                    <input type="date" id="released_tv_show"
                           class="form-control"
                           name="released_tv_show" value="<?php echo e(date('Y-m-d')); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Country:</h4>
                    <input type="text" id="country_tv_show"
                           class="form-control<?php echo e($errors->has('country_tv_show') ? ' is-invalid' : ''); ?>"
                           name="country_tv_show" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Imdb Rating:</h4>
                    <input type="number" id="imdbrating_tv_show"
                           class="form-control"
                           name="imdbrating_tv_show" value="0" step="0.01" required autofocus>
                </div>
            </div>
            <br>
            <h4>Actors :</h4>
            <input type="text" id="actors_tv_show"
                   class="form-control<?php echo e($errors->has('Production_tv_show') ? ' is-invalid' : ''); ?>"
                   name="actors_tv_show" value="N/A" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Language :</h4>
                    <input type="text" id="language_tv_show"
                           class="form-control<?php echo e($errors->has('language_tv_show') ? ' is-invalid' : ''); ?>"
                           name="language_tv_show" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Genre :</h4>
                    <input type="text" id="genre_tv_show"
                           class="form-control<?php echo e($errors->has('genre_tv_show') ? ' is-invalid' : ''); ?>"
                           name="genre_tv_show" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4> Year:</h4>
                    <input type="number" id="year_tv_show" max="2099"
                           value="<?php echo e(date('Y')); ?>"
                           class="form-control" name="year_tv_show" required autofocus>
                </div>
            </div>
            <br>
            <h4>Plot :</h4>
            <input type="text" id="plot_tv_show"
                   class="form-control<?php echo e($errors->has('plot_tv_show') ? ' is-invalid' : ''); ?>"
                   name="plot_tv_show" value="N/A" required autofocus><br>
            <h4>Trailer Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="trailer_tv_show" name="trailer_tv_show" type="text" class="form-control"
                       placeholder="Enter Trailer Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="trailer_function_tv_show(event)">Apply
                        Trailer
                    </button>
                </div>
            </div>
            <input type="text" id='trailer_value_tv_show' name="trailer_value_tv_show" value="N/A" required
                   autofocus><br><br>
            <iframe id='trailer_frame_tv_show' target="trailer_frame_tv_show" name="trailer_frame_tv_show"
                    width="500" height="345" src="" style="visibility:hidden;display:none;">
            </iframe>
            <h4>Poster Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="poster_url_tv_show" name="poster_url_tv_show" type="text" class="form-control"
                       placeholder="Enter Poster Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="poster_function_tv_show(event)">Apply
                        Poster
                    </button>
                </div>
            </div>
            <input id='poster_url_value_tv_show' type="text" name="poster_url_value_tv_show" value="N/A"
                   required autofocus><br><br>
            <img id="poster_frame_tv_show" value="" name="poster_frame_tv_show" src="" width="500" height="750"
                 style="visibility:hidden;display:none;">
            <!-- cover photo -->
            <h4>Cover Photo:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="cover_url_tv_show" type="text" class="form-control" placeholder="Enter Cover Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="Cover_function_tv_show(event)">Apply Cover
                    </button>
                </div>
            </div>
            <input class="form-control" id='cover_url_value_tv_show' type="text"
                   name="cover_url_value_tv_show" value="N/A" required
                   autofocus><br>
            <img id="cover_frame_tv_show" value="" name="cover_frame_tv_show" src="" width="500"
                 height="281"
                 style="visibility:hidden;display:none;">
            <br>
            <!-- cover photo -->
            <h4>Base Url of the folder of the series:</h4>
            <input id="base_url" type="text" style="width:500px;" name="base_url" placeholder="Enter folder location"
                   required autofocus>
            <br>
            <input class="btn btn-primary mt-2 mb-2 col-md-12" type='submit' value="submit"/>
        </form>
    </div>
    <!--///////////////////////////////////Tv  division end //////////////////////////////////////////-->
    <!--/////////////////////////////////////////-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script  type="text/javascript" src="<?php echo e(asset('js/dashboard_tv_show.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>