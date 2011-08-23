<?php
	// $array = array of parsed results to display
	// $template = file to include in loop
	// (optional)$args = associative array of value pairs to be used in template this or template file.
	// (optional)$return_count the number of records you want to show as long as number is less than your defined records per page
	
	/*
	$args array options:
	
	'ul_id' : the id that you want to assign to the <ul> of the list
	'ul_class' : the class that you want to assign to the <ul> of the list
	*/
	
	global $args;
	if(isset($args)) extract($args);
	// checks to see if the $array var is set.  this is an array of records
	if($array){
		echo '<ul ';
		echo 'class="clearfix listing';
		if(isset($ul_class) && !empty($ul_class)) echo ' ' . $ul_class;
		echo '"';
		if(isset($ul_id) && !empty($ul_id)) echo 'id="'.$ul_id.'"';
		echo ' >';
		foreach($array as $index => $el){
			include $template;
		}
		echo '</ul>';
	}
?>