@extends('layouts.dashboard_app')
@section('content')

<?php
if(!empty($table_row[0]->id))
{
	$id = $table_row[0]->id;
	$title = $table_row[0]->title;
	$genre = $table_row[0]->genre;
	$plot =  str_replace("&nbsp;", ' ',htmlspecialchars_decode($table_row[0]->plot));
	$trailer_value = $table_row[0]->trailer_value;
	$poster_url_value = $table_row[0]->poster_url_value;
	$cover_url_value = $table_row[0]->cover_url_value;
	$download_link= $table_row[0]->download_link;
}
else {
	$id = "N/A";
	$title ="N/A";
	$genre = "N/A";
	$plot ="N/A";
	$trailer_value = "N/A";
	$poster_url_value ="N/A";
	$download_link="N/A";
}
;
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<div class='container'>
	<form action = "{{ url('save_edited_pc_games/'.Session::get('pc_game_id')) }}" method = "POST">
		@csrf
		<h4>Title: </h4>
		<input  type="text" id="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"  name="title" value="<?php echo $title  ?>" required autofocus>
		<br>
		<h4>Genre : </h4>
		<input  type="text" id="genre" class="form-control{{ $errors->has('genre') ? ' is-invalid' : '' }}"  name="genre" value="<?php echo $genre  ?>" required autofocus>
		<br>
		<h4>plot : </h4>
		<input  type="text" id="plot" class="form-control{{ $errors->has('plot') ? ' is-invalid' : '' }}"  name="plot" value="<?php echo htmlspecialchars($plot)  ?>" required autofocus>
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
		<input id='poster_url_value' type="text" name="poster_url_value" value="<?php echo $poster_url_value ?>" required  autofocus><br>
		<img id="poster_frame" value= "" name="poster_frame" src="{{url($poster_url_value)}}" width="500" height="750">
		<br>
		<!-- cover -->
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
            <input id="cover_url" name="cover_url" type="text" class="form-control" placeholder="Enter Cover Link">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="CoverFunction(event)">Apply Cover</button>
            </div>
        </div>
		<input id='cover_url_value' type="text" name="cover_url_value" value="<?php echo $cover_url_value ?>" required  autofocus><br>
		<img id="cover_frame" value= "" name="cover_frame" src="{{url($cover_url_value)}}" width="500" height="281">
		<br>
		<!-- cover -->
		<!-- Download Link section starts here -->
		<h4> Enter Folder Link of the game : </h4>
		<input type="text" value="{{$download_link}}"  name="download_links_pc_games" class="form-control" required>
		<!-- Download Link section ends here -->
		<input class="btn btn-primary  mb-4 col-md-12 mt-4"  type = 'submit' value = "submit"/>
	</form>
</div>
@endsection