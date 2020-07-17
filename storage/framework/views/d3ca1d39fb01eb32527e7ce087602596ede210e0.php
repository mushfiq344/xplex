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
            <button class="tablinks">Explore</button>
        </a>
        <?php if(Session::get('admin_type')=='admin'): ?>
            <a href="<?php echo e(url('dashboard_game')); ?>">
                <button class="tablinks active">Games</button>
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
    <div id="Games" class="tabcontent" style="display:block;">
        <!--/////////////////////////////////////////-->
        <!--///////////////////////////////////////////////////////////////////////////////////////////////////-->
        <!-- loader for tv_show    -->
        <div style="display: flex; margin-top: 30px">
            <div class="extra">
                <p>Type Game's Name Here :</p>
                <input class="form-control" style="width: 20%; float: left;" autocomplete="off" type="text"
                       id="search_game" placeholder="search game">
                <button class="btn btn-primary" id="search_button" style="margin-left: 5px;"> Search <i
                            class="fa fa-search"></i>
                </button>
            </div>
            <div id="spin_game" class="loader" style="display: none"></div>
        </div>
        <br>
        <!-- loader for movie    -->
        <table class="table table-bordered table-hover extra">
            <thead>
                <tr>
                    <th> Suggestions</th>
                </tr>
            </thead>
            <tbody id="tbody_game">
            </tbody>
        </table>
        <!--///////////////////////////////////////////-->
        <form action="<?php echo e(url('insert_game')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h4> Title:</h4>
            <input type="text" id="title_game"
                   class="form-control"
                   name="title_game" value="" placeholder="Enter title here" required autofocus>
            <input type="text" id="igdb_id" style="display: none;"
                   class="form-control"
                   name="igdb_id" value="N/A" required autofocus>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h4> Release Date:</h4>
                    <input type="date" id="released_game"
                           class="form-control"
                           name="released_game" value="<?php echo e(date('Y-m-d')); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Production House :</h4>
                    <input type="text" id="publisher_game"
                           class="form-control<?php echo e($errors->has('publisher_game') ? ' is-invalid' : ''); ?>"
                           name="publisher_game" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4> Rating:</h4>
                    <input type="number" id="rating_game"
                           class="form-control" step="0.01"
                           name="rating_game" value="0" required autofocus>
                </div>
            </div>
            <br>
            <h4>Genre :</h4>
            <input type="text" id="genre_game"
                   class="form-control<?php echo e($errors->has('genre_game') ? ' is-invalid' : ''); ?>"
                   name="genre_game" value="N/A" required autofocus><br>
            <h4>Plot :</h4>
            <input type="text" id="plot_game"
                   class="form-control<?php echo e($errors->has('plot_game') ? ' is-invalid' : ''); ?>" name="plot_game"
                   value="N/A" required autofocus><br>
            <h4>Trailer Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="trailer_game" name="trailer_game" type="text" class="form-control"
                       placeholder="Enter Trailer Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="trailer_function_game(event)">Apply Trailer
                    </button>
                </div>
            </div>
            <input type="text" id='trailer_value_game' name="trailer_value_game" value="N/A" required
                   autofocus><br>
            <iframe id='trailer_frame_game' target="trailer_frame_game" name="trailer_frame_game"
                    width="500" height="345" src="" style="visibility:hidden;display:none;">
            </iframe>
            <br>
            <h4>Poster Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="poster_url_game" name="poster_url_game" type="text" class="form-control"
                       placeholder="Enter Poster Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="Poster_function_game(event)">Apply Poster
                    </button>
                </div>
            </div>
            <input id='poster_url_value_game' type="text" name="poster_url_value_game" value="N/A" required
                   autofocus><br>
            <img id="poster_frame_game" value="" name="poster_frame_game" src="" width="500" height="750"
                 style="visibility:hidden;display:none;"><br>
            <!-- cover -->
            <h4>Cover link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="cover_url_game" name="cover_url_game" type="text" class="form-control"
                       placeholder="Enter Poster Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="cover_function_game(event)">Apply cover
                    </button>
                </div>
            </div>
            <input id='cover_url_value_game' type="text" name="cover_url_value_game" value="N/A" required
                   autofocus><br>
            <img id="cover_frame_game" value="" name="cover_frame_game" src="" width="500" height="281"
                 style="visibility:hidden;display:none;"><br>
            <!-- cover -->
            <h4> Enter Game Folder Link :</h4>
            <input class="form-control" type="text" name="download_links_game" placeholder="Enter download link"
                   required>
            <input class="btn btn-primary mt-2 mb-2 col-md-12" type='submit' value="submit"/>
        </form>
        <!--///////////////////////////////////////////-->
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>