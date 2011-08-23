<?php 
if(logged_in()){
	$weather_location = options('weather_location');
} else {
	$weather_location = '34986';
}

	$weather = UI::weather($weather_location);
	if(!empty($weather)){
?>
<div id="localize-widget">
<ul id="weather-quicklinks" class="clearfix">
	<li>Locally:</li>
	<li class="active"><a href="#">Weather</a></li>
  <li>|</li>
	<li><a href="#">Traffic</a></li>
</ul>
<div id="weather-widget">
<div class="weather">
	<span class="temp"><span class="num"><?php echo $weather['now']['temp_f'] ?></span>&deg;F</span> <span class="condition"><?php echo $weather['now']['condition'] ?></span>
</div><!--/weather-->
<p class="location-changer"><span class="location"><?php echo $weather['location'] ?></span> (<a href="#">change</a>)</p>
<img src="<?php echo get_bloginfo('template_directory').'/images/weather/'. get_weather_condition_image(str_replace(' ', '', strtolower($weather['now']['condition'])))?>" class="image"/>
<span class="image "></span>
</div>
<?php include 'traffic-widget.php';?>
</div><!--/localize-widget-->
<?php }
?>