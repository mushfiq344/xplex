<?php $__env->startSection('head_js'); ?>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    

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
            <button class="tablinks active">Movies</button>
        </a>
        <a href="<?php echo e(url('dashboard_tv_show')); ?>">
            <button class="tablinks">TV Shows</button>
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
    <!--///////////////Movie Division Starts//////////////////////////-->
    <div id="Movies" class="tabcontent" style="display:block;">
        <!-- loader for movie starts-->
        <div style="display: flex; margin-top: 30px">
            <div class="extra"> Enter the imDB url : <input type="text" id="search_movie"
                                                            placeholder="Enter imdb link here"></div>
            <div id="spin_movie" class="loader" style="display: none"></div>
        </div>
        <br>

        <!-- loader for movie   ends -->
        <form action="<?php echo e(url('insert_movie')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input id="imdb_id_movie" type="text" name="imdb_id_movie" value="N/A" style="display: none">
            <h4> Title:</h4>
            <input type="text" id="title_movie"
                   class="form-control" name="title_movie"
                   value="" placeholder="Enter movie title here" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4> Release Date:</h4>
                    <input type="date" id="released_movie"
                           class="form-control"
                           name="released_movie" value="<?php echo e(date('Y-m-d')); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4> Year:</h4>
                    <input type="number" max="2099" id="year_movie"
                           class="form-control" name="year_movie" value="<?php echo e(date('Y')); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Country:</h4>
                    <input type="text" id="country_movie"
                           class="form-control<?php echo e($errors->has('country_movie') ? ' is-invalid' : ''); ?>"
                           name="country_movie"
                           value="N/A" required autofocus>
                </div>
            </div>
            <br>
            <h4>Actors :</h4>
            <input type="text" id="actors_movie"
                   class="form-control<?php echo e($errors->has('Production_movie') ? ' is-invalid' : ''); ?>"
                   name="actors_movie" value="N/A" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Production House :</h4>
                    <input type="text" id="production_movie"
                           class="form-control<?php echo e($errors->has('production_movie') ? ' is-invalid' : ''); ?>"
                           name="production_movie" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Language :</h4>
                    <input type="text" id="language_movie"
                           class="form-control<?php echo e($errors->has('language_movie') ? ' is-invalid' : ''); ?>"
                           name="language_movie" value="N/A" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Director :</h4>
                    <input type="text" id="director_movie"
                           class="form-control<?php echo e($errors->has('director_movie') ? ' is-invalid' : ''); ?>"
                           name="director_movie" value="N/A" required autofocus>
                </div>
            </div>
            <br>
            <h4>Genre :</h4>
            <input type="text" id="genre_movie"
                   class="form-control<?php echo e($errors->has('genre_movie') ? ' is-invalid' : ''); ?>" name="genre_movie"
                   value="N/A" required autofocus><br>
            <h4>Plot :</h4>
            <input type="text" id="plot_movie"
                   class="form-control<?php echo e($errors->has('plot_movie') ? ' is-invalid' : ''); ?>" name="plot_movie"
                   value="N/A" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Imdb Rating:</h4>
                    <input type="number" id="imdbrating_movie"
                           class="form-control" value="0" step="0.01"
                           name="imdbrating_movie" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4> Rotten tomatoes Rating:</h4>
                    <input type="number" id="rottentomatoesrating_movie"
                           class="form-control" name="rottentomatoesrating_movie" value="0" step="0.01" required
                           autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Metacritic Rating:</h4>
                    <input type="number" id="metacriticrating_movie"
                           class="form-control"
                           name="metacriticrating_movie" value="0" step="0.01" required autofocus>
                </div>
            </div>
            <br>
            <h4>Trailer Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="trailer_movie" type="text" class="form-control" placeholder="Enter Trailer Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="trailer_function_movie(event)">Apply
                        Trailer
                    </button>
                </div>
            </div>
            <input class="form-control" type="text" id='trailer_value_movie' name="trailer_value_movie" value="N/A"
                   required
                   autofocus><br>
            <iframe class="form-controller" id='trailer_frame_movie' target="trailer_frame_movie"
                    name="trailer_frame_movie" width="80%" height="360" src=""
                    style="visibility:hidden;display:none;">
            </iframe>
            <br>
            <h4>Poster Link:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="poster_url_movie" type="text" class="form-control" placeholder="Enter Poster Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="Poster_function_movie(event)">Apply Poster
                    </button>
                </div>
            </div>
            <input class="form-control" id='poster_url_value_movie' type="text" name="poster_url_value_movie"
                   value="N/A" required
                   autofocus><br>
            <img id="poster_frame_movie" value="" name="poster_frame_movie" src="" width="500" height="700"
                 style="visibility:hidden;display:none;">
            <h4>Cover Photo:</h4>
            <div class="input-group mb-2" style="width: 85%">
                <input id="cover_url_movie" type="text" class="form-control" placeholder="Enter Cover Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="Cover_function_movie(event)">Apply Cover
                    </button>
                </div>
            </div>
            <input class="form-control" id='cover_url_value_movie' type="text"
                   name="cover_url_value_movie" value="N/A" required
                   autofocus><br>
            <img id="cover_frame_movie" value="" name="cover_frame_movie" src="" width="500"
                 height="281"
                 style="visibility:hidden;display:none;">
            <br>
            <!-- Download Link section for Movie starts here -->

            <div class="row">
                <div class="col-md-6">
                    <label>Resolution:</label>
                    <select name="resolution" class="form-control" style="height: 30px;">
                        <option value="720p">720p</option>
                        <option value="1080p">1080p</option>
                        <option value="4k">4k</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Quality:</label>
                    <select name="quality" class="form-control" style="height: 30px;">
                        <option value="WEB-DL">WEB-DL</option>
                        <option value="HDRip">HDRip</option>
                        <option value="BluRay">BluRay</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Type:</label>
                    <input name="type_movie" id="type_movie" class="form-control" value="Hollywood"
                           style="display: none;">
                    <select name="type_movie_select" class="form-control" style="height: 30px;" id="type_movie_select"
                            onchange="document.getElementById('type_movie').value=document.getElementById('type_movie_select').value">
                        <option value="3D Movie"></option>
                        <option value="Animation">HDRip</option>
                        <option value="Arabic">Arabic</option>
                        <option value="Bangladeshi">Bangladeshi</option>
                        <option value="Bollywood">Bollywood</option>
                        <option value="Chinese">Chinese</option>
                        <option value="Foreign">Foreign</option>
                        <option value="French">French</option>
                        <option value="German">German</option>
                        <option value="Hollywood" selected>Hollywood</option>
                        <option value="Hong Kong">Hong Kong</option>
                        <option value="Indian Bangla">Indian Bangla</option>
                        <option value="Italian">Italian</option>
                        <option value="Korean">Korean</option>
                        <option value="Malayalam">Pakistani</option>
                        <option value="Persian">Persian</option>
                        <option value="Polish">Polish</option>
                        <option value="Russian">Russian</option>
                        <option value="Spanish">Spanish</option>
                        <option value="Tamil">Tamil</option>
                        <option value="Thai">Thai</option>
                    </select>
                </div>
            </div>


            <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
            <br/>
            <div id="file_container">
                <a id="pickfiles" href="javascript:;">[Select files]</a>
                <a id="uploadfiles" href="javascript:;">[Upload files]</a>
            </div>
            <br/>
            <pre id="console"></pre>
            <!-- Download Link section for Movie ends here -->
            <input id="submit_movie" disabled="true" class="btn btn-primary mt-2 mb-2 col-md-12" type='submit'
                   value="submit"/>
        </form>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js//js/plupload.full.min.js')); ?>"></script>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script  type="text/javascript" src="<?php echo e(asset('js/dashboard_movie.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>