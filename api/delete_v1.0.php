<?php
	
	extract($data->getRequestVars());

	switch ($target_type):
		case 'tip':
			if($id){
				$tip = new Tip($id);
				if($tip->uid != 0){
					$tip->delete();
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
		break;
		case 'member':
			if($id){
				$member = new Member($id);
				if($member->uid != 0){
					$member->delete();
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
		break;
		case 'user':
			if($id){
				$user = new APIUser($id);
				if(isset($user->email)){
					$user->edit();
					echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','user_id'=>$id)));
					exit;
				} else {
					echo RestUtils::sendResponse(400, '');
					exit;
				}
			} else {
				echo RestUtils::sendResponse(400, '');
				exit;
			}
		break;
		case 'comment':
			if($id){
				$comment = new APIUser($id);
				if($comment->comment != ''){
					$comment->delete();
					echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','comment_id'=>$id)));
					exit;
				} else {
					echo RestUtils::sendResponse(400, '');
					exit;
				}
			} else {
				echo RestUtils::sendResponse(400, '');
				exit;
			}
		break;
	endswitch;