<?php
$path = "https://api.telegram.org/bot1981081794:AAG3LTrHyuTEAk3bcoSAcATP7CJU3nBWyP0";

$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

if (strpos($message, '/n') === 0) {
$location = strtoupper(substr($message, 3));
$weather = json_decode(file_get_contents ("http://190.4.63.192/reportes/bot/test.php?nodo=".$location),true);
 $emoji = "\xf0\x9f\x98\x81";
 $emoj2 ="\xF0\x9F\x98\xAC";
 foreach ($weather as $pc) { 
    $npa= $pc["NPA_HOY"]." ";
    $npa_avg= $pc["NPA_AVG"]." ";
}
  $noencontrado=urlencode(" no se encuentra el Nodo: ".$location);
 $msg=urlencode("*Informacion del Nodo* \n").
      urlencode("Nodo:"  .$location."\n").
      urlencode("NPA:"  .$npa."\n").
      urlencode("NPA (Avg 7 dias):"  .$npa_avg."\n").
      urlencode("Departamento:"  .$location."\n").
      urlencode("Ciudad:"  .$location."\n").
      urlencode("Colonia/Nodo:"  .$location."\n").
      urlencode("Supervisor:"  .$location."\n").
      urlencode("CMTS:"  .$location."\n");
 
 
 if (empty($npa)) 
    {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$noencontrado.'&parse_mode=markdown'); } 
    else 
    {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$msg.'&parse_mode=markdown'); } 
}
?>
