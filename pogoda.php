<?php
/**
 * Created by PhpStorm.
 * User: s.manczak
 * Date: 31.03.2017
 * Time: 13:51
 */



$miejscowosc = "Poznań";

$pogoda_url = "http://api.openweathermap.org/data/2.5/weather?q=".$miejscowosc."&units=metric&lang=pl&appid=72b813464c95f09e1c29a4f25bf2ec43";


$header = get_headers($pogoda_url)[0];

if(preg_match('[200]',$header)) {
    $json = file_get_contents($pogoda_url);
    //echo $json;
    $pogoda = json_decode($json);
    print_r($pogoda);
    echo "<br>";
    $temp = $pogoda->main->temp;
    echo $temp;
}
