<?php

class Previsioni {
	
	
	public function show($citta) {
		$xml = simplexml_load_file("http://www.google.com/ig/api?weather=".urlencode($citta));
		$information = $xml->xpath("/xml_api_reply/weather/forecast_information");
		$current = $xml->xpath("/xml_api_reply/weather/current_conditions");
		$forecast_list = $xml->xpath("/xml_api_reply/weather/forecast_conditions");
		
        echo "<div class=\"title\"><strong>$citta</strong><br/>";
        
       
        echo "<img src=\"http://www.google.com".$current[0]->icon['data']."\" width=\"100\" height=\"70\" alt=\"". $current[0]->condition['data']."\" />";
		 echo "<div class=\"temp\">";
			echo round(($current[0]->temp_f['data']*1-32)*5/9)." &deg;C";
			echo "</div>";
       	echo "</div>";
       
        
		
	}
		
}
	
function meteo($citta) {
	$t=new Previsioni();
	$t->show($citta);
}
?>


