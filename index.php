<?php
$path = "https://api.telegram.org/bot1981081794:AAG3LTrHyuTEAk3bcoSAcATP7CJU3nBWyP0";

$update = json_decode(file_get_contents("php://input"), TRUE);

$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];

if (strpos($message, '/n') === 0) {
$location = strtoupper(substr($message, 3));
$weather = json_decode(file_get_contents ("http://190.4.63.192/reportes/bot/test.php?nodo=".$location),true);
 
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
 if ($x >85 && $x <90 ){$emoji ="\xF0\x9F\x98\xA2";}
 if ($x <=85   ){$emoji ="\xF0\x9F\x98\xA1";}
 
 if ($x >90 ){$emoj2 = "\xF0\x9F\x98\x83";}
 if ($x >85 && $x <90 ){$emoj2 ="\xF0\x9F\x98\xA2";}
 if ($x <=85   ){$emoj2 ="\xF0\x9F\x98\xAD";}
 
  $noencontrado=urlencode(" <pre>no se encuentra el Nodo: ".$location."</pre>");
 $msg=urlencode("<b><pre>Informacion del Nodo</pre></b>").urlencode("\n").
      urlencode("<pre>Nodo: "  .$location."</pre>").urlencode("\n").
      urlencode("<pre>NPA: "  .$x."</pre>").$emoji.urlencode("\n").
      urlencode("<pre>NPA (Avg 7 dias): "  .$npa_avg."</pre>").$emoj2.urlencode("\n").
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

/*codigo para resultado supervisores
*/

if (strpos($message, '/s') === 0) {
$weather = json_decode(file_get_contents ("http://190.4.63.192/reportes/bot/supervisor.php"),true);
 
 foreach ($weather as $pc) { 
    $x= $pc["NPA"]." ";
    $nombre= $pc["NOMBRE"]." ";
 
}
 
 if ($x >90 ){$emoji = "\xf0\x9f\x98\x81";}
 if ($x >85 && $x <90 ){$emoji ="\xF0\x9F\x98\xA2";}
 if ($x <=85   ){$emoji ="\xF0\x9F\x98\xA1";}
 
 if ($x >90 ){$emoj2 = "\xF0\x9F\x98\x83";}
 if ($x >85 && $x <90 ){$emoj2 ="\xF0\x9F\x98\xA2";}
 if ($x <=85   ){$emoj2 ="\xF0\x9F\x98\xAD";}
 
  $noencontrado=urlencode(" <pre>no se encuentra el Nodo: ".$location."</pre>");
 $msg=urlencode("<pre> | Tables | Are | Cool | |----------|:-------------:|------:| | col 1 is | left-aligned | $1600 | | col 2 is | centered | $12 | | col 3 is | right-aligned | $1 | </pre>").urlencode("\n").
      urlencode("<pre>Nodo: "  .$nombre."</pre>").urlencode("\n").
      urlencode("<pre>NPA: "  .$x."</pre>").$emoji.urlencode("\n") ;
 
 
 if (empty($x)) 
    else 
    {file_get_contents($path."/sendmessage?chat_id=".$chatId."&text=".$msg.'&parse_mode=html'); } 
}



?>
