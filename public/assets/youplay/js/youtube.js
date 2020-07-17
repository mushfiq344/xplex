//    This function is for youtube hover

    $(".testHover").mouseover(function () {
        console.log("entered");
        $src_link =  ($('#iframe').attr("src"));
        $embed = $src_link.substr(30,11);
        $link = $(this).attr('id');
        $change_url = $src_link.replace($embed, $link);
        $('#iframe').attr("src",$change_url);
        $title = $(this).attr('title');
        $('#main_image_name').text($title);
        $download_link = $(this).attr('download');
        $('#download_btn').attr("href",$download_link);
    });

