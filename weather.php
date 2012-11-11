<?php

class Weather {
	
	public function show($zipcode) {
		$result = file_get_contents('http://weather.yahooapis.com/forecastrss?p=' . $zipcode . '&u=f');
		$xml = simplexml_load_string($result);
		
		$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
		$location = $xml->channel->xpath('yweather:location');
		
		if(!empty($location)){
			foreach($xml->channel->item as $item){
				$current = $item->xpath('yweather:condition');
				$forecast = $item->xpath('yweather:forecast');
				$current = $current[0];
				?>
			
				<h1 style="margin-bottom: 0">Weather for <?php echo $location[0]['city']; ?>, <?php echo $location[0]['region']; ?></h1>
				<small><?php echo$current['date']; ?></small>
				<h2>Current Conditions</h2>
				<p>
				<span style="font-size:72px; font-weight:bold;"><?php $current['temp']; ?>&deg;C</span>
				<br/>
				<img src="http://l.yimg.com/a/i/us/we/52/{$current['code']}.gif" style="vertical-align: middle;"/>&nbsp;
				<?php echo $current['text']; ?>
				</p>
				<h2>Forecast</h2>
				<?php echo $forecast[0]['day'];?> - <?php echo $forecast[0]['text']; ?>. High: <?php echo $forecast[0]['high']; ?> Low: <?php echo $forecast[0]['low']; ?>
				<br/>
				<?php echo $forecast[1]['day']; ?> - <?php echo $forecast[1]['text']; ?>. High: ?php echo $forecast[1]['high']; ?> Low: <?php $forecast[1]['low']; ?>
				</p>
				<?php
			}
		}else{
				echo '<h1>No results found.</h1>';
			}

	}
		
}
	
function weather($city) {
	$t=new Weather();
	$t->show($city);
}
?>


