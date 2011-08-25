<?php

	extract($data->getRequestVars());

	$args = false;
	
	if(isset($target_args) && !empty($target_args)){
		$args = $target_args;
	}
	
	$pg = isset($_GET['pg'])?$_GET['pg']:false;
	$rp = isset($_GET['rp'])?$_GET['rp']:10;
	
	if($target_type == 'tip'){
		if($args && isset($args['id'])){
			$tip = new Tip($args['id']);
			if($tip->uid != 0){
				echo RestUtils::sendResponse(200, json_encode($tip));
			} else {
				echo RestUtils::sendResponse(400, '');
			}
		} else {
			if(isset($action)){
				switch($action){
					case 'search':
						if(isset($_GET['tag'])){
							$results = Tag::getSimilarTips($_GET['tag']);
							echo RestUtils::sendResponse(200, json_encode($results));
						} else if(isset($_GET['tip_ids'])){
							$tips = explode(',',$_GET['tip_ids']);
							$results = Tip::getTips($tips, true, false, $pg, $rp);
							echo RestUtils::sendResponse(200, json_encode($results));
						}
					break;
				}
			} else {
				if($results = Tip::getAll(true, false, $pg, $rp)){
					echo RestUtils::sendResponse(200, json_encode($results));
				}
			}
		}
	}