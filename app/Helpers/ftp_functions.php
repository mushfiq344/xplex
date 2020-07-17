<?php
function  get_game_folder_contents($folder){
    $json=file_get_contents('http://103.55.146.165/FTP/XplexScanner/ParseSingleOtherFolder.php?f=' .myUrlEncode(ltrim($folder, '/')));
    $obj = json_decode($json);
    // return var_dump($obj);
    $address = get_ip_for_single_link('http://103.55.146.165/FTP/');
    foreach ($obj->items as $item) {
        if($item->type=="file"){
            $item->path=$address.myUrlEncode(ltrim($item->path,'/'));
        }else{
             $item->path="ftp/Games/".myUrlEncode(ltrim($item->path,'/'));
        }
        # code...
    }
    return $obj->items;

}



// softwares function  
function get_other_folder_contents($folder){


    $json=file_get_contents('http://103.55.146.165/FTP/XplexScanner/ParseSingleOtherFolder.php?f=' .myUrlEncode(ltrim($folder, '/')));
    $obj = json_decode($json);
    // return var_dump($obj);
     $address = get_ip_for_single_link('http://103.55.146.165/FTP/');
    foreach ($obj->items as $item) {
        if($item->type=="file"){
            $item->path=$address.myUrlEncode(ltrim($item->path,'/'));
        }else{
             $item->path="ftp/Others/".myUrlEncode(ltrim($item->path,'/'));
        }
        # code...
    }
    return $obj->items;

}

function get_back_button($folder){
    $button = explode('/', $folder);
    
    if (strpos($button[0], 'Others') !== false
        ) {
        return "ftp/Others/".substr($folder, 0, strrpos($folder, '/'));
    }else{
        return "ftp/Games/".substr($folder, 0, strrpos($folder, '/'));
    }
}



function get_file_icon($name)
    {
        // get extension

        $ext = checkExtension($name);

        switch ($ext) {
            case 'ico':
            case 'gif':
            case 'jpg':
            case 'jpeg':
            case 'jpc':
            case 'jp2':
            case 'jpx':
            case 'xbm':
            case 'wbmp':
            case 'png':
            case 'bmp':
            case 'tif':
            case 'tiff':
            case 'svg':
                $img = 'fa fa-picture-o';
                break;
            case 'passwd':
            case 'ftpquota':
            case 'sql':
            case 'js':
            case 'json':
            case 'sh':
            case 'config':
            case 'twig':
            case 'tpl':
            case 'md':
            case 'gitignore':
            case 'c':
            case 'cpp':
            case 'cs':
            case 'py':
            case 'map':
            case 'lock':
            case 'dtd':
                $img = 'fa fa-file-code-o';
                break;
            case 'txt':
            case 'ini':
            case 'conf':
            case 'log':
            case 'htaccess':
                $img = 'fa fa-file-text-o';
                break;
            case 'css':
            case 'less':
            case 'sass':
            case 'scss':
                $img = 'fa fa-css3';
                break;
            case 'zip':
            case 'rar':
            case 'gz':
            case 'tar':
            case '7z':
                $img = 'fa fa-file-archive-o';
                break;
            case 'php':
            case 'php4':
            case 'php5':
            case 'phps':
            case 'phtml':
                $img = 'fa fa-code';
                break;
            case 'htm':
            case 'html':
            case 'shtml':
            case 'xhtml':
                $img = 'fa fa-html5';
                break;
            case 'xml':
            case 'xsl':
                $img = 'fa fa-file-excel-o';
                break;
            case 'wav':
            case 'mp3':
            case 'mp2':
            case 'm4a':
            case 'aac':
            case 'ogg':
            case 'oga':
            case 'wma':
            case 'mka':
            case 'flac':
            case 'ac3':
            case 'tds':
                $img = 'fa fa-music';
                break;
            case 'm3u':
            case 'm3u8':
            case 'pls':
            case 'cue':
                $img = 'fa fa-headphones';
                break;
            case 'avi':
            case 'mpg':
            case 'mpeg':
            case 'mp4':
            case 'm4v':
            case 'flv':
            case 'f4v':
            case 'ogm':
            case 'ogv':
            case 'mov':
            case 'mkv':
            case '3gp':
            case 'asf':
            case 'wmv':
                $img = 'fa fa-file-video-o';
                break;
            case 'eml':
            case 'msg':
                $img = 'fa fa-envelope-o';
                break;
            case 'xls':
            case 'xlsx':
                $img = 'fa fa-file-excel-o';
                break;
            case 'csv':
                $img = 'fa fa-file-text-o';
                break;
            case 'bak':
                $img = 'fa fa-clipboard';
                break;
            case 'doc':
            case 'docx':
                $img = 'fa fa-file-word-o';
                break;
            case 'ppt':
            case 'pptx':
                $img = 'fa fa-file-powerpoint-o';
                break;
            case 'ttf':
            case 'ttc':
            case 'otf':
            case 'woff':
            case 'woff2':
            case 'eot':
            case 'fon':
                $img = 'fa fa-font';
                break;
            case 'pdf':
                $img = 'fa fa-file-pdf-o';
                break;
            case 'psd':
            case 'ai':
            case 'eps':
            case 'fla':
            case 'swf':
                $img = 'fa fa-file-image-o';
                break;
            case 'exe':
            case 'msi':
                $img = 'fa fa-file-o';
                break;
            case 'bat':
                $img = 'fa fa-terminal';
                break;
            case 'iso':
                $img = 'fa fa-file-archive-o';
                break;
            default:
                $img = 'fa fa-info-circle';
        }

        return $img;
    }

        function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

        function checkExtension($name)
    {
        //$name = "21.Jump.Street.2012.720p.RC.BluRay-Assassins.mkv";
        $ext = strtolower($name);
        //$ext = strrev($ext); //reverse a string so that part of the extension comes at the first occurrences
        //$ext = strstr($ext, '.', true);      //return the substring limited to first occurrences to '.'
        //$ext = strrev($ext);  //again reverse the string to get the original extension format
        $ext = strrev(strstr(strrev($ext), '.', true));
        return $ext;
    }
?>