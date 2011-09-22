<?php

switch($target_type){
	case 'tip':
	if($values = $data->getRequestVars()){
		if(isset($values['tip']) && isset($values['title']) && !empty($values['tip']) && !empty($values['title'])) {
			$values['tags'] = (array)json_decode(stripslashes($values['tags']));
			if($id = Tip::add($values)){
				echo RestUtils::sendResponse(201, json_encode(array('status'=>'ok','tip_id'=>$id)), 'application/json', Tip::permalink($id));
				exit;
			} else {
				echo RestUtils::sendResponse(400, '', 'application/json');
				exit;
			}
		}
	}
	break;
	case 'rating':
	if($values = $data->getRequestVars()){
		if(isset($values['actor_uid']) && isset($values['target_uid'])) {
			if(Rating::add($values['actor_uid'], $values['target_uid'], $values['rating'])){
				echo RestUtils::sendResponse(201, json_encode(array('status'=>'ok')), 'application/json', Tip::permalink($id));
				exit;
			} else {
				echo RestUtils::sendResponse(400, '', 'application/json');
				exit;
			}
		}
	}	
	break;
	case 'comment':
	if($values = $data->getRequestVars()){
		if(isset($values['comment']) && isset($values['ancestor_uid'])) {
			if($id = Comment::add($values)){
				echo RestUtils::sendResponse(201, json_encode(array('status'=>'ok', 'comment_id'=>$id)), 'application/json', Comment::permalink($id));
				exit;
			} else {
				echo RestUtils::sendResponse(400, '', 'application/json');
				exit;
			}
		}
	}	
	break;
	case 'member':
	if($values = $data->getRequestVars()){
		if($id = Member::add($values)){
			echo RestUtils::sendResponse(201, json_encode(array('status'=>'ok', 'comment_id'=>$id)), 'application/json', Comment::permalink($id));
			exit;
		} else {
			echo RestUtils::sendResponse(400, '', 'application/json');
			exit;
		}
	}	
	break;
}