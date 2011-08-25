<?php

	extract($data->getRequestVars());

	$args = false;
	
	if(isset($target_args) && !empty($target_args)){
		$args = $target_args;
	}
	
	if($target_type == 'tip'){
		if($args && isset($args['id'])){
			$tip = new Tip($args['id']);
			if(isset($tip->uid)){
				echo RestUtils::sendResponse(200, json_encode($tip));
			} else {
				echo RestUtils::sendResponse(400, '');
			}
		} else {
			if($results = Tip::getAll(true, false, false)){
				echo RestUtils::sendResponse(200, json_encode($results));
			}
		}
	}