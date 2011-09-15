<?php

	extract($data->getRequestVars());

	$args = false;
	
	if(isset($target_args) && !empty($target_args)){
		$args = $target_args;
	}
	
	if($target_type == 'tip'){
		if($args && isset($args['id'])){
			$tip = new Tip($args['id']);
			if($tip->uid != 0){
				$tip->edit($data->getRequestVars());
				echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','tip_id'=>$id)));
				exit;
			} else {
				echo RestUtils::sendResponse(400, '');
				exit;
			}
		} else {
			echo RestUtils::sendResponse(400, '');
			exit;
		}
	}