<?php
include('geoip.php');
include('titles.php');
$gi = geoip_open('GeoIP.dat', GEOIP_MEMORY_CACHE);
$country = geoip_country_id_by_addr($gi, isset($_GET['ip']) ? $_GET['ip'] : $_SERVER['REMOTE_ADDR']);
geoip_close($gi);
$remoteImage = "flag/" . $COUNTRY_CODE[$country] . ".gif";
header("Content-type: image/gif");
readfile($remoteImage);
?>