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
    $x= $pc["NPA_HOY"]." ";
    $npa_avg= $pc["NPA_AVG"]." ";
    $departamento= $pc["DEPARTAMENTO"]." ";
    $ciudad= $pc["CIUDAD"]." ";
    $colonia= $pc["COLONIA"]." ";
    $supervisor= $pc["SUPERVISOR"]." ";
    $cmts= $pc["CMTS"]." ";
}
 
 if ($x >90 ){$emoji = "\xf0\x9f\x98\x81";}
  $noencontrado=urlencode(" <pre>no se encuentra el Nodo: ".$location."</pre>");
 $msg=urlencode("<b><pre>Informacion del Nodo</pre></b>").urlencode("\n").
      urlencode("<pre>Nodo: "  .$location."</pre>").urlencode("\n").
      urlencode("<pre>NPA: "  .$x."</pre>").$emoji.urlencode("\n").
      urlencode("<pre>NPA (Avg 7 dias): "  .$npa_avg."</pre>").urlencode("\n").
      urlencode("<pre>Departamento: "  .$supervisor."</pre>").urlencode("\n").
      urlencode("<pre>Ciudad:       "  .$ciudad."</pre>").urlencode("\n").
      urlencode("<pre>Colonia/Nodo: "  .$colonia."</pre>").urlencode("\n").
      urlencode("<pre>Supervisor:   "  .$supervisor."</pre>").urlencode("\n").
      urlencode("<pre>CMTS: "  .$cmts."</pre>");
 
 
 if (empty($x)) 
    {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$noencontrado.'&parse_mode=html'); } 
    else 
    {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$msg.'&parse_mode=html'); } 
}
?>
