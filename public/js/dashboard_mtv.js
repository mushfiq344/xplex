function check_show_type(event) {
    var e = document.getElementById("show_type");
    var show_type = e.options[e.selectedIndex].value;
    if (show_type == 'Tv Show') {
        document.getElementById('select_tv_show').style.display = 'block';
        document.getElementById('select_cartoon').style.display = 'none';
        document.getElementById('select_music_video').style.display = 'none';
        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'block';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';



    } else if (show_type == 'Cartoon') {


        document.getElementById('select_tv_show').style.display = 'none';
        document.getElementById('select_cartoon').style.display = 'block';
        document.getElementById('select_music_video').style.display = 'none';
        document.getElementById('select_bangla_natok_type').style.display = 'none';


        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (show_type == 'Music Video') {

        document.getElementById('select_tv_show').style.display = 'none';
        document.getElementById('select_cartoon').style.display = 'none';
        document.getElementById('select_music_video').style.display = 'block';
        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'block';

    }
}

function check_tv_show_type(event) {
    var e = document.getElementById("tv_show_type");
    var tv_show_type = e.options[e.selectedIndex].value;
    if (tv_show_type == 'Bangla Natok') {

        document.getElementById('select_bangla_natok_type').style.display = 'block';

        document.getElementById('bengali_actors_main_form').style.display = 'block';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (tv_show_type == 'Bangla Short Film') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'block';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (tv_show_type == 'Hindi Tv Show') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';


        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'block';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';


    } else if (tv_show_type == 'Indian Bangla Serial' || tv_show_type == 'Indian Bangla Tv Show') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';


        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'block';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    }

}

function check_music_video_type(event) {
    var e = document.getElementById("music_video_type");
    var music_video_type = e.options[e.selectedIndex].value;
    if (music_video_type == 'Hindi Movie Song') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'block';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (music_video_type == 'Bangla Music Video' || music_video_type == 'Bangla Band') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'block';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (music_video_type == 'Hindi Music Song') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'block';
        document.getElementById('english_music_artist_main_form').style.display = 'none';

    } else if (music_video_type == 'English Music Video') {

        document.getElementById('select_bangla_natok_type').style.display = 'none';

        document.getElementById('bengali_actors_main_form').style.display = 'none';
        document.getElementById('indian_bengali_actors_main_form').style.display = 'none';
        document.getElementById('hindi_actors_main_form').style.display = 'none';
        document.getElementById('hindi_movie_actors_main_form').style.display = 'none';
        document.getElementById('bengali_music_artist_main_form').style.display = 'none';
        document.getElementById('hindi_music_artist_main_form').style.display = 'none';
        document.getElementById('english_music_artist_main_form').style.display = 'block';

    }

}


$(document).ready(function() {

    $('body').on("click", "#add_more_bengali_actors", function(e) { //user click on remove text
        var htmlString = $("#bengali_actors_copy").html();
        e.preventDefault();
        $("#bengali_actors_main_form").append(htmlString);

    });

    $('body').on("click", "#add_more_indian_bengali_actors", function(e) { //user click on remove text
        var htmlString = $("#indian_bengali_actors_copy").html();
        e.preventDefault();
        $("#indian_bengali_actors_main_form").append(htmlString);

    });


    $('body').on("click", "#add_more_hindi_actors", function(e) { //user click on remove text
        var htmlString = $("#hindi_actors_copy").html();
        e.preventDefault();
        $("#hindi_actors_main_form").append(htmlString);

    });

    $('body').on("click", "#add_more_hindi_movie_actors", function(e) { //user click on remove text
        var htmlString = $("#hindi_movie_actors_copy").html();
        e.preventDefault();
        $("#hindi_movie_actors_main_form").append(htmlString);

    });

    $('body').on("click", "#add_more_bengali_music_artist", function(e) { //user click on remove text
        var htmlString = $("#bengali_music_artist_copy").html();
        e.preventDefault();
        $("#bengali_music_artist_main_form").append(htmlString);

    });

    $('body').on("click", "#add_more_english_music_artist", function(e) { //user click on remove text
        var htmlString = $("#english_music_artist_copy").html();
        e.preventDefault();
        $("#english_music_artist_main_form").append(htmlString);

    });

    $('body').on("click", "#add_more_hindi_music_artist", function(e) { //user click on remove text
        var htmlString = $("#hindi_music_artist_copy").html();
        e.preventDefault();
        $("#hindi_music_artist_main_form").append(htmlString);

    });



    $('body').on("click", ".remove_actor", function(e) { //user click on remove text
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});