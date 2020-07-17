$(document).ready(function() {
    $(document).on("click", "#search_button", function() {
        $value = $("#search_game").val();
        if ($value.trim().length != 0) {
            $.ajax({
                type: 'get',
                url: '/search_game',
                data: { 'search': $value },
                success: function(data) {
                    console.log(data);
                    $('#tbody_game').html(data);
                }
            });
        } else {
            $('#tbody_game').html("");
        }
    });
});



$(document).ready(function() {
    $(document).on("click", ".clickMe", function() {
        $value = this.id;
        $class = this.className;
        $("#search_game").val(" ");
        $('tbody_game').html(" ");
        console.log($value);
        $("#igdb_id").val($value);
        if ($class == 'clickMe') {
            $('#spin_game').fadeIn(300);
        }
        $.ajax({
            type: 'get',
            url: '/search_single_game',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $('#tbody_game').html(" ");
                $('#spin_game').fadeOut(300);
                console.log(data);
                $('input[name=title_game]').val(data['title']);
                $('input[name=released_game]').val(data['released']);
                $('input[name=publisher_game]').val(data['publisher']);
                $('input[name=genre_game]').val(data['genre']);
                $('input[name=plot_game]').val(data['plot']);
                $('input[name=rating_game]').val(data['rating']);
                if (data['trailer'] != 'N/A') {
                    var str1 = "https://www.youtube.com/watch?v=";
                    var res1 = str1.concat(data['trailer']);
                    $('input[name=trailer_value_game]').val(res1);
                    var str2 = "https://www.youtube.com/embed/";
                    var res2 = str2.concat(data['trailer']);
                    $('#trailer_frame_game').attr('src', res2);
                    $('#trailer_frame_game').css('visibility', 'visible');
                    $('#trailer_frame_game').css('display', 'inline');
                }
                if (data['poster'] != 'N/A') {
                    $('input[name=poster_url_value_game]').val(data['poster']);
                    $('#poster_frame_game').attr('src', data['poster']);
                    $('#poster_frame_game').css('visibility', 'visible');
                    $('#poster_frame_game').css('display', 'inline');
                }if (data['cover'] != 'N/A') {
                    $('input[name=cover_url_value_game]').val(data['cover']);
                    $('#cover_frame_game').attr('src', data['cover']);
                    $('#cover_frame_game').css('visibility', 'visible');
                    $('#cover_frame_game').css('display', 'inline');
                }
            }
        });
    });
});


function trailer_function_game(event) {
    event.preventDefault();
    var x = document.getElementById("trailer_game").value;
    document.getElementById('trailer_value_game').value = x;
    if (document.getElementById('trailer_game').value !== "") {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = x.match(regExp);
        if (match && match[2].length == 11) {
            res = match[2];
        } else {}
        var str1 = 'https://www.youtube.com/embed/';
        var result = str1.concat(res);
        document.getElementById('trailer_frame_game').src = result;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('trailer_frame_game').style.visibility = 'visible';
        document.getElementById('trailer_frame_game').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
    }
}


function Poster_function_game(event) {
    event.preventDefault();
    var x = document.getElementById("poster_url_game").value;
    if (document.getElementById('poster_url_game').value !== "") {
        document.getElementById('poster_frame_game').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_frame_game').style.visibility = 'visible';
        document.getElementById('poster_frame_game').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('poster_url_value_game').value = x;
    }
}

function cover_function_game(event) {
    event.preventDefault();
    var x = document.getElementById("cover_url_game").value;
    if (document.getElementById('cover_url_game').value !== "") {
        document.getElementById('cover_frame_game').src = x;
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_frame_game').style.visibility = 'visible';
        document.getElementById('cover_frame_game').style.display = 'inline';
        //////////////////////////////////////////////////////////////////////////
        document.getElementById('cover_url_value_game').value = x;
    }
}