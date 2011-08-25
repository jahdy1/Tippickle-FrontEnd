<?php

// add Tip to db
if($target_type == 'tip'){
	if($values = $data->getRequestVars()){
		if(isset($values['tip']) && isset($values['title']) && !empty($values['tip']) && !empty($values['title'])) {
			$values['tags'] = (array)json_decode(stripslashes($values['tags']));
			if($id = Tip::add($values)){
				echo RestUtils::sendResponse(201, json_encode(array('status'=>'ok','tip_id'=>$id)), 'application/json', Tip::permalink($id));
			} else {
				echo RestUtils::sendResponse(400, '', 'application/json');
			}
		}
	}
}