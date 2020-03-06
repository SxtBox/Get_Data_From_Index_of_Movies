<?php

/*
 Get Movies From Index Pages
 Platform: KODI
 Author: TRC4@USA.COM
*/

ob_start();
error_reporting(0);

date_default_timezone_set("Europe/Tirane");

$LOGO_PATH = "https://cdn.dribbble.com/users/1304441/screenshots/3695049/film_logo_dribbble.png"; // REPLACE WITH YOUR LOGO

/*
NOTE:
INDEX OF MOVIES DON'T HAVE THE STRUCTURE SAME, IF NOT, YOU NEED TO CHANGE THE REGEX CODE ONLY
TO FIND MOVIES JUST SEARCH ON GOOGLE FOR 'index of movies'
EXAMPLE http://130.185.144.63/Movies/
*/
$API_HOST = 'http://localhost/example_data'; // INPUT INDEX OF MOVIES PATH
$GET_DATA = file_get_contents($API_HOST);

header("Content-Type: application/rss+xml; charset=utf-8");

preg_match_all('/alt=".VID."><.td><td><a href="(.*?)">(.*?)<.a><.td>.*?".*?">(.*?)<.td>.*?".*?">(.*?)</', // REGEX http://rubular.com/r/PyG6uShOr9
    $GET_DATA, $content, PREG_SET_ORDER);

foreach ($content as $item) {
    $title         = rawurldecode(strtoupper($item[1])); // TITLE
    $stream        = stripslashes(trim($API_HOST . $item[1])); // STREAM
    $Released_Date = stripslashes(trim($item[3])); // RELEASED DATE
    $Madhesia      = stripslashes(trim($item[4])); // MADHESIA
    
    echo "<item>\n";
    echo "<title>[COLOR lime][B]" . $title . "[/COLOR][/B]</title>\n";
    echo "<link>" . $stream . "</link>\n";
    echo "<Madhesia>" . $Madhesia . "</Madhesia>\n";
    echo "<Released_Date>" . $Released_Date . "</Released_Date>\n";
    echo "<thumbnail>" . $LOGO_PATH . "</thumbnail>\n";
    echo "<fanart>" . $LOGO_PATH . "</fanart>\n";
    echo "</item>\n\n";
} {
}
ob_end_flush();
?>