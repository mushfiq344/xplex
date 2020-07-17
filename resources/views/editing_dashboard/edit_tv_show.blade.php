@extends('layouts.dashboard_app')
@section('content')

<?php
if(!empty($table_row[0]->id))
{
	$title = $table_row[0]->title;
	$imdb_title = $table_row[0]->imdb_title;
	$id = $table_row[0]->id;
	$title = $table_row[0]->title;
	$released = $table_row[0]->released;
	$genre = $table_row[0]->genre;
	$actors = $table_row[0]->actors;
	$plot = str_replace("&nbsp;", ' ',htmlspecialchars_decode($table_row[0]->plot));
	$imdbrating = $table_row[0]->imdbrating;
	$trailer_value = $table_row[0]->trailer_value;
	$poster_url_value = $table_row[0]->poster_url_value;
	$cover_url_value = $table_row[0]->cover_url_value;
	$base_url =  $table_row[0]->base_url;

	$year = $table_row[0]->year;
	$language = $table_row[0]->language;
	$country = $table_row[0]->country;


}
else {
	$title = "N/A";
	$imdb_title = "N/A";
	$id = "N/A";
	$title ="N/A";
	$released = "N/A";
	$genre = "N/A";
	$actors = "N/A";
	$plot ="N/A";
	$imdbrating = "N/A";
	$trailer_value = "N/A";
	$poster_url_value ="N/A";
	$base_url="N/A";
}
;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<div class='container'>
	<form action = "{{ url('save_edited_tv_show/'.Session::get('tv_show_id')) }}" method = "POST">
		@csrf
		<h4> Title: </h4>
		<input  type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  name="title" value="<?php echo $title  ?>" required autofocus>
		<h4> Imdb Title: </h4>
		<input  type="text" id="imdb_title" class="form-control"  name="imdb_title" value="{{$imdb_title}}" required autofocus>
		<div class="row">
			<div class="col-md-4">
				<h4>Release Date: </h4>
				<input type="date" id="released" class="form-control"  name="released" value="<?php echo $released ?>" required autofocus>
			</div>
			<div class="col-md-4">
				<h4>Imdb  Rating: </h4>
				<input type="number" step="0.01"  id="imdbrating" class="form-control" name="imdbrating" value="{{$imdbrating}}" required autofocus>
		    </div>
		    <div class="col-md-4">
				<h4>Genre : </h4>
				<input  type="text" id="genre" class="form-control{{ $errors->has('genre') ? ' is-invalid' : '' }}"  name="genre" value="<?php echo $genre  ?>" required autofocus>
			</div>
		</div><br>
			<div class="row">
			<div class="col-md-4">
				<h4>Year: </h4>
				<input type="number"  max="2099" id="year" class="form-control"  name="year" value="{{$year}}" required autofocus>
			</div>
			<div class="col-md-4">
				<h4>Language: </h4>
				<input type="text"  id="language" class="form-control" name="language" value="{{$language}}" required autofocus>
		    </div>
		    <div class="col-md-4">
				<h4>Country:</h4>
				<input  type="text" id="country" class="form-control"  name="country" value="{{$country}}" required autofocus>
			</div>
		</div><br>
		<h4>Actors : </h4>
		<input  type="text" id="actors" class="form-control{{ $errors->has('Production') ? ' is-invalid' : '' }}"  name="actors" value="<?php echo $actors  ?>" required autofocus>
		<br>
		<h4>Plot : </h4>
		<input  type="text" id="plot" class="form-control{{ $errors->has('plot') ? ' is-invalid' : '' }}"  name="plot" value="<?php echo htmlspecialchars($plot) ?>" required autofocus>
		<br>
		<h4>Trailer Link: </h4>
		<script>
		function trailerFunction(event) {
			event.preventDefault();
			var x = document.getElementById("trailer").value;
			document.getElementById('trailer_value').value = x;
			if (document.getElementById('trailer').value!==""){
				var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
				var match = x.match(regExp);
				if (match && match[2].length == 11) {
					res = match[2];
				} else {}
				var str1= 'https://www.youtube.com/embed/';
				var result = str1.concat(res);
				document.getElementById('trailer_frame').src =result;
				//////////////////////////////////////////////////////////////////////////
				document.getElementById('trailer_frame').style.visibility = 'visible';
				document.getElementById('trailer_frame').style.display = 'inline';
				//////////////////////////////////////////////////////////////////////////
			}
		}
		</script>
		<div class="input-group mb-2" style="width: 85%">
            <input id="trailer" name="trailer" type="text" class="form-control" placeholder="Enter Trailer Link">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="trailerFunction(event)">Apply Trailer</button>
            </div>
        </div>
		<input type="text" id='trailer_value'  name="trailer_value" value="<?php echo $trailer_value ?>" required autofocus><br><br>
		<iframe  id='trailer_frame' target="trailer_frame" name="trailer_frame" width="500" height="345" src="" style="visibility:hidden;display:none;">
		</iframe>
		<h4>Poster Link: </h4>
		<script>
		function PosterFunction(event) {
			event.preventDefault();
			var x = document.getElementById("poster_url").value;
			if (document.getElementById('poster_url').value!==""){
				document.getElementById('poster_frame').src =x;
				//////////////////////////////////////////////////////////////////////////
				document.getElementById('poster_frame').style.visibility = 'visible';
				document.getElementById('poster_frame').style.display = 'inline';
				//////////////////////////////////////////////////////////////////////////
				document.getElementById('poster_url_value').value =x;
			}
		}
		</script>
		<div class="input-group mb-2" style="width: 85%">
            <input id="poster_url" name="poster_url" type="text" class="form-control" placeholder="Enter Poster Link">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="PosterFunction(event)">Apply Poster</button>
            </div>
        </div>
		<input id='poster_url_value' type="text" name="poster_url_value" value="<?php echo $poster_url_value ?>" required  autofocus><br><br>
		<img id="poster_frame" value= "" name="poster_frame" src="{{url($poster_url_value)}}" width="500" height="750">
		<!-- cover photo -->
		<h4>Cover Link: </h4>
		<script>
		function CoverFunction(event) {
			event.preventDefault();
			var x = document.getElementById("cover_url").value;
			if (document.getElementById('cover_url').value!==""){
				document.getElementById('cover_frame').src =x;
				//////////////////////////////////////////////////////////////////////////
				document.getElementById('cover_frame').style.visibility = 'visible';
				document.getElementById('cover_frame').style.display = 'inline';
				//////////////////////////////////////////////////////////////////////////
				document.getElementById('cover_url_value').value =x;
			}
		}
		</script>
		<div class="input-group mb-2" style="width: 85%">
            <input id="cover_url" name="cover_url" type="text" class="form-control" placeholder="Enter Poster Link">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="CoverFunction(event)">Apply Poster</button>
            </div>
        </div>
		<input id='cover_url_value' type="text" name="cover_url_value" value="<?php echo $cover_url_value ?>" required  autofocus><br><br>
		<img id="cover_frame" value= "" name="cover_frame" src="{{url($cover_url_value)}}" width="500" height="281">
		<h4>Base url : </h4>
		<input id='base_url' type="text" name="base_url" value="<?php echo $base_url ?>" required  autofocus><br>
		<input class="btn btn-primary  mb-4 col-md-12 mt-4"  type = 'submit' value = "submit"/>
	</form>
</div>
@endsection