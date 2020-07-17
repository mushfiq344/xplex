$(document).ready(function() {
    $("#search_movie").keyup(function() {
        $value = $(this).val();
        $('#spin_movie').fadeIn(300);
        console.log($value);
        $value = $value.replace("https://www.imdb.com/title/", "");
        $value = $value.replace("/", "");
        $.ajax({
            type: 'get',
            url: '/search_movie',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#spin_movie').fadeOut(300);
                console.log(data);
                $('input[name=imdb_id_movie]').val(data['imdb_id']);
                $('input[name=title_movie]').val(data['title']);
                $('input[name=released_movie]').val(data['released']);
                $('input[name=year_movie]').val(data['year']);
                $('input[name=country_movie]').val(data['country']);
                $('input[name=production_movie]').val(data['production']);
                $('input[name=actors_movie]').val(data['actors']);
                $('input[name=language_movie]').val(data['language']);
                $('input[name=director_movie]').val(data['director']);
                $('input[name=genre_movie]').val(data['genre']);
                $('input[name=plot_movie]').val(data['plot']);
                $('input[name=imdbrating_movie]').val(data['imdb']);
                $('input[name=rottentomatoesrating_movie]').val(data['rt']);
                $('input[name=metacriticrating_movie]').val(data['metacritic']);
                if (data['trailer'] != 'N/A') {
                    var str1 = "https://www.youtube.com/watch?v=";
                    var res1 = str1.concat(data['trailer']);
                    $('input[name=trailer_value_movie]').val(res1);
                    var str2 = "https://www.youtube.com/embed/";
                    var res2 = str2.concat(data['trailer']);
                    $('#trailer_frame_movie').attr('src', res2);
                    $('#trailer_frame_movie').css('visibility', 'visible');
                    $('#trailer_frame_movie').css('display', 'inline');
                }
                else{
                     $('input[name=trailer_value_movie]').val("N/A");
                }
                if (data['poster'] != 'N/A') {
                    $('input[name=poster_url_value_movie]').val(data['poster']);
                    $('#poster_frame_movie').attr('src', data['poster']);
                    $('#poster_frame_movie').css('visibility', 'visible');
                    $('#poster_frame_movie').css('display', 'inline');
                }
                else
                {
                    $('input[name=poster_url_value_movie]').val("N/A");
                }
                // cover
                if (data['cover'] != 'N/A') {
                    $('input[name=cover_url_value_movie]').val(data['cover']);
                    $('#cover_frame_movie').attr('src', data['cover']);
                    $('#cover_frame_movie').css('visibility', 'visible');
                    $('#cover_frame_movie').css('display', 'inline');
                }
                else
                {
                    $('input[name=cover_url_value_movie]').val("N/A");
                }

            }
        });
    });
});

///////////////////////////////////////////////////////////
function trailer_function_movie(event) {
    event.preventDefault();
    var x = document.getElementById("trailer_movie").value;
    document.getElementById('trailer_value_movie').value = x;
    if (document.getElementById('trailer_movie').value !== "") {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = x.match(regExp);
        if (match && match[2].length == 11) {
            res = match[2];
        } else {}
        var str1 = 'https://www.youtube.com/embed/';
        var result = str1.concat(res);
        document.getElementById('trailer_frame_movie').src = result;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('trailer_frame_movie').style.visibility = 'visible';
        document.getElementById('trailer_frame_movie').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
    }
}

///////////////////////////////////////////////////////////
function Poster_function_movie(event) {
    event.preventDefault();
    var x = document.getElementById("poster_url_movie").value;
    if (document.getElementById('poster_url_movie').value !== "") {
        document.getElementById('poster_frame_movie').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_frame_movie').style.visibility = 'visible';
        document.getElementById('poster_frame_movie').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_url_value_movie').value = x;
    }
}


///////////////////////////////////////////////////////////
function Cover_function_movie(event) {
    event.preventDefault();
    var x = document.getElementById("cover_url_movie").value;
    if (document.getElementById('cover_url_movie').value !== "") {
        document.getElementById('cover_frame_movie').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_frame_movie').style.visibility = 'visible';
        document.getElementById('cover_frame_movie').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_url_value_movie').value = x;
    }
}

// Custom example logic

var uploader = new plupload.Uploader({
    runtimes : 'html5,flash,silverlight,html4',
    browse_button : 'pickfiles', // you can pass an id...
    container: document.getElementById('file_container'), // ... or DOM Element itself
    url : 'http://43.230.123.18/fancyindex/XplexScanner/upload.php',
    flash_swf_url : '{{asset("js/js/Moxie.swf")}}',
    silverlight_xap_url : '{{asset("js/js/Moxie.xap")}}',
    chunk_size:'1mb',
    filters : {
        max_file_size : '3000mb',
        mime_types: [
            {title : "Image files", extensions : "jpg,gif,png"},
            {title : "Zip files", extensions : "zip"},
            {title : "Video files", extensions : "mp4"}
        ]
    },

    init: {

        PostInit: function() {

            document.getElementById('filelist').innerHTML = '';

            document.getElementById('uploadfiles').onclick = function() {


                var title=document.getElementById('title_movie').value;
                var year=document.getElementById('year_movie').value;
                var movie_folder = title+'('+year+')';
                var type = document.getElementById('type_movie').value;
                //
                uploader.settings.url+='?t='+type+'&y='+year+'&f='+movie_folder;


                uploader.start();
                return false;
            };
        },

        FilesAdded: function(up, files) {


            //
            plupload.each(files, function(file) {
                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
            });
        },

        UploadProgress: function(up, file) {



            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
            document.getElementById("title_movie").readOnly = true;
            document.getElementById("year_movie").readOnly= true;
            document.getElementById("type_movie_select").setAttribute("disabled", "disabled");
            document.getElementById("submit_movie").disabled=false;
        },

        Error: function(up, err) {
            document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
        }
    }
});

uploader.init();
console.log(uploader);