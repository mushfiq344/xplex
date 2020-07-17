<?php $__env->startSection('head_js'); ?>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
    // var_dump($table_row[0]);

    if (!empty($table_row->id)) {
        $title = $table_row->title;
        $imdb_title = $table_row->imdb_title;
        $id = $table_row->id;
        $title = $table_row->title;
        $released = $table_row->released;
        $language = $table_row->language;
        $production = $table_row->production;
        $year = $table_row->year;
        $country = $table_row->country;
        $genre = $table_row->genre;
        $director = $table_row->director;
        $actors = $table_row->actors;
        $plot = str_replace("&nbsp;", ' ', htmlspecialchars_decode($table_row->plot));
        $imdbrating = $table_row->imdbrating;
        $rottentomatoesrating = $table_row->rottentomatoesrating;
        $metacriticrating = $table_row->metacriticrating;
        $trailer_value = $table_row->trailer_value;
        $poster_url_value = $table_row->poster_url_value;
        $cover_url_value = $table_row->cover_url_value;
        $download_link = $table_row->download_link;
        $type = $table_row->type;
    } else {
        $imdb_title = "N/A";
        $id = "N/A";
        $title = "N/A";
        $released = "N/A";
        $language = "N/A";
        $production = "N/A";
        $year = "N/A";
        $country = "N/A";
        $genre = "N/A";
        $director = "N/A";
        $actors = "N/A";
        $plot = "N/A";
        $imdbrating = "0";
        $rottentomatoesrating = "0";
        $metacriticrating = "0";
        $trailer_value = "N/A";
        $poster_url_value = "N/A";
        $download_link = "N/A";
        $cover_url_value = "N/A";
    }
    ;?>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
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
    <div class='tabcontent' style="display:block;">
        <br>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(url('dashboard_explore')); ?>">Explore</a></li>
                <?php if($table=="movie"): ?>
                    <li class="breadcrumb-item"><a href="<?php echo e(url('show_movies')); ?>">show Movies</a></li>
                <?php else: ?>
                    <li class="breadcrumb-item"><a href="<?php echo e(url('show_requested_movies')); ?>">Movies For Approval</a></li>
                <?php endif; ?>

                <li class="breadcrumb-item active" aria-current="page">Edit Movie</li>
            </ol>
        </nav>
        <form action="<?php echo e(url('save_edited_movie')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="text" name="id" value="<?php echo e($id); ?>" required autofocus style="display: none;">
            <input type="text" name="table_name" value="<?php echo e($table); ?>" required autofocus style="display: none;">
            <input type="text" name="type" value="<?php echo e($type); ?>" required autofocus style="display: none;">
            <h4> Title: </h4>
            <input type="text" id="title" class="form-control" name="title" value="<?php echo $title  ?>" required
                   autofocus><br>
            <h4> imdb Title: </h4>
            <input type="text" id="imdb_title" class="form-control" name="imdb_title" value="<?php echo e($imdb_title); ?>" required
                   autofocus><br>
            <div class="row ml-0" style="padding: 0;margin: 0">
                <div class="cold-md-3 ml-4">
                    <h4> Release Date: </h4>
                    <input type="date" id="released" class="form-control" name="released" value="<?php echo e($released); ?>" required
                           autofocus>
                </div>
                <div class="cold-md-3 ml-4">
                    <h4> Year: </h4>
                    <input type="number" max="2099" id="year" class="form-control" name="year"
                           value="<?php echo $year  ?>" required autofocus>
                </div>
                <div class="cold-md-3 ml-4">
                    <h4>Country: </h4>
                    <input type="text" id="country"
                           class="form-control<?php echo e($errors->has('country') ? ' is-invalid' : ''); ?>" name="country"
                           value="<?php echo $country ?>" required autofocus>
                </div>
                <div class="col-md-3 ml-3 mr-0">
                    <h4>Director : </h4>
                    <input type="text" id="director"
                           class="form-control<?php echo e($errors->has('director') ? ' is-invalid' : ''); ?>" name="director"
                           value="<?php echo $director  ?>" required autofocus>
                </div>
            </div>
            <br>
            <h4>Actors : </h4>
            <input type="text" id="actors" class="form-control<?php echo e($errors->has('Production') ? ' is-invalid' : ''); ?>"
                   name="actors" value="<?php echo $actors  ?>" required autofocus>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Production House : </h4>
                    <input type="text" id="production"
                           class="form-control<?php echo e($errors->has('production') ? ' is-invalid' : ''); ?>" name="production"
                           value="<?php echo $production  ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Language : </h4>
                    <input type="text" id="language"
                           class="form-control<?php echo e($errors->has('language') ? ' is-invalid' : ''); ?>" name="language"
                           value="<?php echo $language ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Genre : </h4>
                    <input type="text" id="genre" class="form-control<?php echo e($errors->has('genre') ? ' is-invalid' : ''); ?>"
                           name="genre" value="<?php echo $genre  ?>" required autofocus>
                </div>
            </div>
            <br>
            <h4>Plot : </h4>
            <input type="text" id="plot" class="form-control<?php echo e($errors->has('plot') ? ' is-invalid' : ''); ?>" name="plot"
                   value="<?php echo htmlspecialchars($plot) ?>" required autofocus><br>
            <div class="row">
                <div class="col-md-4">
                    <h4>Imdb Rating: </h4>
                    <input type="number" step="0.01" id="imdbrating" class="form-control" name="imdbrating"
                           value="<?php echo e($imdbrating); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4> Rotten tomatoes Rating: </h4>
                    <input type="number" step="0.01" id="rottentomatoesrating" class="form-control"
                           name="rottentomatoesrating" value="<?php echo e($rottentomatoesrating); ?>" required autofocus>
                </div>
                <div class="col-md-4">
                    <h4>Metacritic Rating: </h4>
                    <input type="number" step="0.01" id="metacriticrating" class="form-control" name="metacriticrating"
                           value="<?php echo e($metacriticrating); ?>" required autofocus>
                </div>
            </div>
            <br>
            <h4>Trailer Link: </h4>
            <script>
                function trailerFunction(event) {
                    event.preventDefault();
                    var x = document.getElementById("trailer").value;
                    document.getElementById('trailer_value').value = x;
                    if (document.getElementById('trailer').value !== "") {
                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                        var match = x.match(regExp);
                        if (match && match[2].length == 11) {
                            res = match[2];
                        } else {
                        }
                        var str1 = 'https://www.youtube.com/embed/';
                        var result = str1.concat(res);
                        document.getElementById('trailer_frame').src = result;
                        //////////////////////////////////////////////////////////////////
                        document.getElementById('trailer_frame').style.visibility = 'visible';
                        document.getElementById('trailer_frame').style.display = 'inline';
                        ///////////////////////////////////////////////////////////////
                    }
                }
            </script>
            <div class="input-group mb-2" style="width: 85%">
                <input id="trailer" name="trailer" type="text" class="form-control" placeholder="Enter Trailer Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="trailerFunction(event)">Apply Trailer
                    </button>
                </div>
            </div>
            <input type="text" id='trailer_value' name="trailer_value" value="<?php echo $trailer_value ?>" required
                   autofocus><br><br>
            <iframe id='trailer_frame' target="trailer_frame" name="trailer_frame" width="500" height="345" src=""
                    style="visibility:hidden;display:none;">
            </iframe>
            <h4>Poster Link: </h4>
            <script>
                function PosterFunction(event) {
                    event.preventDefault();
                    var x = document.getElementById("poster_url").value;
                    if (document.getElementById('poster_url').value !== "") {
                        document.getElementById('poster_frame').src = x;
                        //////////////////////////////////////////////////////////////////
                        document.getElementById('poster_frame').style.visibility = 'visible';
                        document.getElementById('poster_frame').style.display = 'inline';
                        ////////////////////////////////////////////////////////////////////
                        document.getElementById('poster_url_value').value = x;
                    }
                }

                function CoverFunction(event) {
                    event.preventDefault();
                    var x = document.getElementById("cover_url").value;
                    if (document.getElementById('cover_url').value !== "") {
                        document.getElementById('cover_frame').src = x;
                        //////////////////////////////////////////////////////////////////
                        document.getElementById('cover_frame').style.visibility = 'visible';
                        document.getElementById('cover_frame').style.display = 'inline';
                        ////////////////////////////////////////////////////////////////////
                        document.getElementById('cover_url_value').value = x;
                    }
                }
            </script>

            <div class="input-group mb-2" style="width: 85%">
                <input id="poster_url" name="poster_url" type="text" class="form-control"
                       placeholder="Enter Poster Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="PosterFunction(event)">Apply Poster</button>
                </div>
            </div>
            <input id='poster_url_value' type="text" name="poster_url_value" value="<?php echo $poster_url_value ?>"
                   required autofocus><br>
            <img id="poster_frame" value="" name="poster_frame" src="<?php echo e(url($poster_url_value)); ?>" width="500"
                 height="750">
            <!-- Cover -->
            <div class="input-group mb-2" style="width: 85%">
                <input id="cover_url" name="cover_url" type="text" class="form-control" placeholder="Enter Cover Link">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" onclick="CoverFunction(event)">Apply Cover</button>
                </div>
            </div>
            <input id='cover_url_value' type="text" name="cover_url_value" value="<?php echo $cover_url_value ?>"
                   required autofocus><br>
            <img id="cover_frame" value="" name="cover_frame" src="<?php echo e(url($cover_url_value)); ?>" width="500" height="281">


            <h4>Download Link Base Url:</h4>
            <input type="text" name="download_link_movie" value="<?php echo e($download_link); ?>">
            <input class="btn btn-primary  mb-4 col-md-12 mt-4" type='submit' value="submit"/>
        </form>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.dashboard_app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>