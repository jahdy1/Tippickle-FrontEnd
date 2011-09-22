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
	if($target_type == 'member'){
		if($args && isset($args['id'])){
			$member = new Member($args['id']);
			if($member->uid != 0){
				$member->edit(Entity::filter($data->getRequestVars(),array_merge(Member::$allowable_fields,array('level'))));
				echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','member_id'=>$id)));
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
	if($target_type == 'user'){
		if($args && isset($args['id'])){
			$user = new APIUser($args['id']);
			if(isset($user->email)){
				$user->edit(Entity::filter($data->getRequestVars(),APIUser::$allowable_fields));
				echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','user_id'=>$args['id'])));
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