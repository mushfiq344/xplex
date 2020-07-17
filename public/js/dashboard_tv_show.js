$(document).ready(function() {
    $("#search_tv_show").keyup(function() {
        $value = $(this).val();
        $('#spin_tv_show').fadeIn(300);
        console.log($value);
        $value = $value.replace("https://www.imdb.com/title/", "");
        $value = $value.replace("/", "");
        $.ajax({
            type: 'get',
            url: '/search_tv_show',
            data: { 'search': $value },
            success: function(data) {
                $('#spin_tv_show').fadeOut(300);
                console.log(data);
                $('input[name=title_tv_show]').val(data['title']);
                $('input[name=released_tv_show]').val(data['released']);
                $('input[name=country_tv_show]').val(data['country']);
                $('input[name=actors_tv_show]').val(data['actors']);
                $('input[name=language_tv_show]').val(data['language']);
                $('input[name=genre_tv_show]').val(data['genre']);
                $('input[name=plot_tv_show]').val(data['plot']);
                $('input[name=imdbrating_tv_show]').val(data['imdb']);
                $('input[name=year_tv_show]').val(data['year']);
                $('input[name=imdb_id_tv_show]').val(data['imdb_id']); 

                if (data['trailer'] != 'N/A') {
                    var str1 = "https://www.youtube.com/watch?v=";
                    var res1 = str1.concat(data['trailer']);
                    $('input[name=trailer_value_tv_show]').val(res1);
                    var str2 = "https://www.youtube.com/embed/";
                    var res2 = str2.concat(data['trailer']);
                    $('#trailer_frame_tv_show').attr('src', res2);
                    $('#trailer_frame_tv_show').css('visibility', 'visible');
                    $('#trailer_frame_tv_show').css('display', 'inline');
                }
                if (data['poster'] != 'N/A') {
                    $('input[name=poster_url_value_tv_show]').val(data['poster']);
                    $('#poster_frame_tv_show').attr('src', data['poster']);
                    $('#poster_frame_tv_show').css('visibility', 'visible');
                    $('#poster_frame_tv_show').css('display', 'inline');
                }if (data['cover'] != 'N/A') {
                    $('input[name=cover_url_value_tv_show]').val(data['cover']);
                    $('#cover_frame_tv_show').attr('src', data['cover']);
                    $('#cover_frame_tv_show').css('visibility', 'visible');
                    $('#cover_frame_tv_show').css('display', 'inline');
                }
            }
        });
    });
});



function trailer_function_tv_show(event) {
    event.preventDefault();
    var x = document.getElementById("trailer_tv_show").value;
    document.getElementById('trailer_value_tv_show').value = x;
    if (document.getElementById('trailer_tv_show').value !== "") {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = x.match(regExp);
        if (match && match[2].length == 11) {
            res = match[2];
        } else {}
        var str1 = 'https://www.youtube.com/embed/';
        var result = str1.concat(res);
        document.getElementById('trailer_frame_tv_show').src = result;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('trailer_frame_tv_show').style.visibility = 'visible';
        document.getElementById('trailer_frame_tv_show').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
    }
}

function poster_function_tv_show(event) {

    event.preventDefault();
    var x = document.getElementById("poster_url_tv_show").value;
    if (document.getElementById('poster_url_tv_show').value !== "" && x.match(/\.(jpeg|jpg|gif|png)$/) != null) {
        document.getElementById('poster_frame_tv_show').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_frame_tv_show').style.visibility = 'visible';
        document.getElementById('poster_frame_tv_show').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_url_value_tv_show').value = x;
    }
}

///////////////////////////////////////////////////////////
function Cover_function_tv_show(event) {
    event.preventDefault();
    var x = document.getElementById("cover_url_tv_show").value;
    if (document.getElementById('cover_url_tv_show').value !== "") {
        document.getElementById('cover_frame_tv_show').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_frame_tv_show').style.visibility = 'visible';
        document.getElementById('cover_frame_tv_show').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_url_value_tv_show').value = x;
    }
}
