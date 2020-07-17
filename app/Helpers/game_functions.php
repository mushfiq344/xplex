<?php 

function get_game_folder($link){
// games
    if (strpos($link, '103.55.146.165/FTP/') !== false
        ) {

            $converted_link=str_replace('103.55.146.165/FTP/',"",$link);
            $converted_link=str_replace('http://',"",
                $converted_link);
            $converted_link=ltrim($converted_link,"/");
            return 'ftp/Games/'.str_replace("index.php?dir=","", $converted_link);

    }      
}


?>