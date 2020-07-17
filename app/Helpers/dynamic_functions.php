<?php

function get_converted_string($link){
    // 172.27.27.242
    if (strpos($link, '103.55.146.165/FTP/') !== false) {
        $converted_link=str_replace('103.55.146.165/FTP/',"",$link);
        $converted_link=str_replace('http://',"", $converted_link);
        $converted_link=ltrim($converted_link,"/");
        return "http://103.55.146.165/FTP/XplexScanner/ParseSingleMediaFolder.php?f=".$converted_link;

    }

}

function get_ip_for_single_link($link){
        if (strpos($link, '103.55.146.165/FTP/') !== false) {
            return  'http://103.55.146.165/FTP/';

        }

}



?>