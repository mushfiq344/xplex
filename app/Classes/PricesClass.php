<?php
namespace App\Classes;
/*
we will fetch games ratings from wikipedia here
*/

class PricesClass {
   /*
    parameter : title of the game
    */

    function extract_rating($title)
    {
        $name = $title; // title is the title of the game 
        $name= urlencode ($name);
        $rating_data= array();

        $result = file_get_contents('https://en.wikipedia.org/w/api.php?action=query&titles='.$name.'&prop=revisions&rvprop=content&format=json&formatversion=2');

        // process the fetched data
        $result2 = (string)$result;
        $string = str_replace(' ', '', $result2);
        $string = str_replace('\n', '', $string);
        $string = str_replace('|', '', $string);
        $string = str_replace('{', '', $string);
        $string = str_replace('}', '', $string);
        $string = str_replace('Rating', '', $string);
        $string = str_replace('(', '', $string);
        $string = str_replace(')', '', $string);
        $string = str_replace('PC', '', $string);



        // IGN 
        if (strpos($string, 'IGN=') !== false) {
            $value = strpos($string, 'IGN=');
            $IGN = substr($string,$value+4,6);
            $IGN = substr($IGN, 0, strpos($IGN, "/"));
            $rating_data['IGN']= $IGN;
        }else {
            $IGN = 'N/A';
        }
        // Gspot
        if (strpos($string, 'GSpot=') !== false) {

            $value = strpos($string, 'GSpot=');
            $gspot = substr($string,$value+6,6);
            $gspot = substr($gspot, 0, strpos($gspot, "/"));
            $rating_data['GameSpot']= $gspot;
        }else {

            $gspot = 'N/A';
        }
        // GRadar

        if (strpos($string, 'GRadar=') !== false) {

            $value = strpos($string, 'GRadar=');
            $GRadar = substr($string,$value+7,1);
            $rating_data['GamesRadar']=   $GRadar;
        }
        else {
            $GRadar = 'N/A';
        }

        // poloygon
        if (strpos($string, 'Poly=') !== false) {

            $value = strpos($string, 'Poly=');
            $polygon = substr($string,$value+5,10);
            $polygon = substr($polygon, 0, strpos($polygon, "/"));
            $rating_data['Polygon']= $polygon;
        }else {
            $polygon = 'N/A';
        }
        // Edge

        if (strpos($string, 'Edge=') !== false) {
            $value = strpos($string, 'Edge=');
            $Edge = substr($string,$value+5,10);
            $Edge = substr($Edge, 0, strpos($Edge, "/"));
            $rating_data['Edge']= $Edge;
        }else {
            $Edge = 'N/A';
        }
        // Destruct
        if (strpos($string, 'Destruct=') !== false) {

            $value = strpos($string, 'Destruct=');
            $destruct = substr($string,$value+9,6);
            $destruct = substr($destruct, 0, strpos($destruct, "/"));
            $rating_data['Destructoid']=  $destruct;

        }else {
            $destruct = 'N/A';
        }
        // GI
        if (strpos($string, 'GI=') !== false) {

            $value = strpos($string, 'GI=');
            $GI = substr($string,$value+3,10);
            $GI = substr($GI, 0, strpos($GI, "/"));
            $rating_data['Game Informer']= $GI;
        }else {
            $GI = 'N/A';
        }
        // EGM
        if (strpos($string, 'EGM=') !== false) {

            $value = strpos($string, 'EGM=');
            $EGM = substr($string,$value+4,10);
            $EGM = substr($EGM, 0, strpos($EGM, "/"));
            $rating_data['EGM']= $EGM;
        }else {
            $EGM = 'N/A';
        }
        // GameRev
        if (strpos($string, 'GameRev=') !== false) {

            $value = strpos($string, 'GameRev=');
            $game_revolution = substr($string,$value+8,10);
            if (strpos($game_revolution, '/')!== false ){

                $game_revolution = substr(    $game_revolution, 0, strpos(    $game_revolution, "/"));
            }
            $game_revolution= (float)  $game_revolution;
            $rating_data['Game Revolution']=  $game_revolution;
        }else {
            $game_revolution = 'N/A';
        }
        // GB
        if (strpos($string, 'GB=') !== false) {

            $value = strpos($string, 'GB=');
            $GB = substr($string,$value+3,1);
            $rating_data['Giant Bomb']=  $GB;

        }else {

            $GB = 'N/A';

        }
        return $rating_data;
    }
}

?>