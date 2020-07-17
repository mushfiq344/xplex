var selection = 0;
var table = 'movie';
function onSelectorClick(select) {
    selection = select;
    var button = document.getElementById("search_type_button");
    if(select == 1){
        button.innerText = 'Games';
        table = 'pc_games';
    }
    else if (select == 2){
        button.innerText = 'TvShow';
        table = 'tv_show';
    }
    else if(select == 0){
        button.innerText = 'Movies';
        table = 'movie';
    }
}

function searchBy(search_value) {

    $('#search_result').empty();
    $('#search_result').css('display', 'none');
    //var pic_pix = '200px';

    if (window.matchMedia('screen and (max-width: 768px)').matches) {
        pic_pix = '180px';
    }

    if (search_value !== '') {

        if(table == 'tv_series')
            table = 'tv_show';
        $('#search_result').innerHTML = '';

    $.ajax({
        type: 'GET',
        url: '/ajax_search',
        data: {'table': table, 'search_value': search_value},
        success: function (data) {

            console.log(data.length);

            if (data.length != 0) {
                $('#search_result').css('display', 'block');
                $.each(data, function (key, value) {
                    if (value.imdbrating === undefined) {
                        $rating_name = "IGDB Rating:";
                        value.imdbrating = value.igdbrating;
                    }
                    else
                        $rating_name = "IMDB Rating:";
                    if (table == 'tv_show') {
                        table = 'tv_series';                  //this code is for difference between route name and table name
                    }

                    if(data.length == 1){
                        $('#search_result').html('                <a class="search_link" href="' + '/' + table + '/' + value.id + '" class="">\n' +
                            '                <div class="row">\n' +
                            '                    <div class="col-md-3 col-xs-4">\n' +
                            '                        <div class="">\n' +
                            '                            <div class="img">\n' +
                            '                                <img  style="border-radius: 10px" src="' + value.poster_url_value + '" alt="">\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="col-md-9 col-xs-8">\n' +
                            '                        <h4>' + value.title + '</h4>\n' +
                            '                        <div class="tags" style="font-size: 15px;">\n' +
                            '                            <i class="fa fa-star"></i> ' + value.imdbrating + '\n' +
                            '                        </div>\n' +
                            '                        <div class="tags" style="font-size: 15px;">\n' +
                            '                            <i class="fa fa-eye"></i> ' + value.total_view + '\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '                </a>\n' +
                            '                <br>')

                    }

                    else {
                        $('#search_result').append('                <a href="' + '/' + table + '/' + value.id + '" class="">\n' +
                            '                <div class="row">\n' +
                            '                    <div class="col-md-3 col-xs-4">\n' +
                            '                        <div class="">\n' +
                            '                            <div class="img">\n' +
                            '                                <img  style="border-radius: 10px" src="' + value.poster_url_value + '" alt="">\n' +
                            '                            </div>\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                    <div class="col-md-9 col-xs-8">\n' +
                            '                        <h4>' + value.title + '</h4>\n' +
                            '                        <div class="tags" style="font-size: 15px;">\n' +
                            '                            <i class="fa fa-star"></i> ' + value.imdbrating + '\n' +
                            '                        </div>\n' +
                            '                        <div class="tags" style="font-size: 15px;">\n' +
                            '                            <i class="fa fa-eye"></i> ' + value.total_view + '\n' +
                            '                        </div>\n' +
                            '                    </div>\n' +
                            '                </div>\n' +
                            '                </a>\n' +
                            '                <br>')
                    }
                })
            }
        },
        error: function (xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            console.log(error);
        }
    })
}
}