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
    $x= $pc["NPA"]." ";
}
 $msg=urlencode(" Informacion del Nodo/n"." id_nodo:".$location."ES:". $x.$emoji);
 $ms2 = urlencode("*Informacion del Nodo* \n"."Node_id:"  .$location."NPA:);
if (empty($x)) 
  {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=NODO NO EXISTE ".$location." ES: ". $x.$emoj2 );
  } else {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$ms2.'&parse_mode=markdown' );
  } 
 

}
?>