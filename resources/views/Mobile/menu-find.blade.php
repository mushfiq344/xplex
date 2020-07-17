<div id="search-page">
    <div class="menu-title">
        <span class="color-highlight">LINK 71</span>
        <h1>Search</h1>
        <a href="#" class="menu-hide"><i class="fa fa-times"></i></a>
    </div>
    <div id="menu-search-list">
        <div class="search search-header">
            <i class="fa fa-search"></i>
            <input id="search_value" type="movie" onkeyup="searchBy(this.value)" type="text" placeholder="Search"
                   data-search>
            <a href="#"><i class="fa fa-times"></i></a>
        </div>
        <div data-simplebar id="search_result">
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            $(".preload-search-image").lazyload({threshold: 0});
        });

        function search_menu() {
            $('[data-search]').on('keyup', function () {
                var searchVal = $(this).val();
                if (searchVal != '') {
                    $('.menu-search-trending').addClass('disabled-search-item');
                    $('#menu-search-list .search-results').removeClass('disabled-search-list');
                    $('#menu-search-list [data-filter-item]').addClass('disabled-search-item');
                    $('#menu-search-list [data-filter-item][data-filter-name*="' + searchVal.toLowerCase() + '"]').removeClass('disabled-search-item');
                }
            });
            return false;
        }

        search_menu();

        $('.menu-search-trending a').on('click', function () {
            var e = jQuery.Event("keydown");
            e.which = 32;
            search_value = $(this).text();
            $('.search-header input').attr("placeholder", search_value);
            $('.search-header input').attr("type", search_value);
            $('.search-results').removeClass('disabled-search-list');
            $('[data-filter-item]').addClass('disabled-search-item');
            $('[data-filter-item][data-filter-name*="' + search_value.toLowerCase() + '"]').removeClass('disabled-search-item');
            $('#search-page').addClass('move-search-list-up');
            $('.search-header a').addClass('search-close-active');
            $('.menu-search-trending').addClass('disabled-search-item');
            return false;
        });

        $('#menu-hider, .close-menu, .menu-hide').on('click', function () {
            $('.menu-box').removeClass('menu-box-active');
            $('#menu-hider').removeClass('menu-hider-active');
            setTimeout(function () {
                $('#search-page').removeClass('move-search-list-up');
            }, 100);
            $('[data-filter-item]').addClass('disabled-search-item');
            $('.search-header input').val('');
            $('.menu-search-trending').removeClass('disabled-search-item');
            $('.search-header a').removeClass('search-close-active');
            $('#search-page').removeClass('move-search-list-up');
            return false;
        });
        $('#menu-search-list input').on('focus', function () {
            $('#search-page').addClass('move-search-list-up');
            $('.search-header a').addClass('search-close-active');
            return false;
        })
        $('.search-header a').on('click', function () {
            $('.menu-search-trending').removeClass('disabled-search-item');
            $('#menu-search-list .search-results').addClass('disabled-search-list');
            $('.search-header input').val('');
            $('#search-page').removeClass('move-search-list-up');
            $('.search-header a').removeClass('search-close-active');
            return false;
        });
    </script>

    <script>
        function searchBy(search_value) {
            var search_table = document.getElementById('search_value').getAttribute("type");
            $('#search_result').empty();
            $('#search_result').css('display', 'none');
            if (search_value !== '') {
                $('#search_result').innerHTML = '';
                $.ajax({
                    type: 'GET',
                    url: '/ajax_all_search',
                    data: {'search_value': search_value},
                    success: function (data) {
                        //var type = Object.keys(data[0])[0];           //get movie

                        if (data.length != 0)
                            $('#search_result').css('display', 'block');

                        data.forEach((element) => {
                            var type = Object.keys(element)[0];
                            var table;
                            if (type == "Movies") {
                                table = 'movie';
                            } else if (type == "Tv Show") {
                                table = 'tv_series';
                            } else if (type == "Pc Games") {
                                table = 'pc_games';
                            }
                            element[type].forEach((element2) => {

                                if (type == "Pc Games")
                                    element2.imdbrating = element2.igdbrating;
                                $('#search_result').append(`<a href="/mobile_search/${table}/${element2.id}">
                    <div data-filter-item data-filter-name="all products mega mobile" class="search-result-list">
                    <img height="67px;" href="/mobile_search/${table}/${element2.id}" src="${element2.poster_url_value}">
                    <h1>${element2.title}</h1>
                    <h4>${type}</h4>
                    <a class="rating" href=""><i class="fa fa-star color-red-light"></i> ${element2.imdbrating} </a>
                     </div></a><br>`);
                            });
                        })
                    },
                    error: function (xhr, status, error) {
                        var err = eval("(" + xhr.responseText + ")");
                        console.log(error);
                    }
                })
            }
        }


    </script>

</div>