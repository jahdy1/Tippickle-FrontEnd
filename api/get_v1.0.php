<?php

	extract($data->getRequestVars());

	$args = false;
	
	if(isset($target_args) && !empty($target_args)){
		$args = $target_args;
	}
	
	$pg = isset($_GET['pg'])?$_GET['pg']:false;
	$rp = isset($_GET['rp'])?$_GET['rp']:10;
	$descending = isset($_GET['asc'])? false: true;
	$active = !isset($_GET['active'])? false: true;
	
	switch($target_type):
		case 'tip':
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
								if(isset($_GET['count'])){
									$results = Tag::getSimilarTipsCount(urldecode($_GET['tag']));
								} else {
									$results = Tag::getSimilarTips(urldecode($_GET['tag']), $pg, $rp);
								}
								echo RestUtils::sendResponse(200, json_encode($results));
							} else if(isset($_GET['tip_ids'])){
								$tips = explode(',',$_GET['tip_ids']);
								if(isset($_GET['count'])){
									$results = Tip::getTipsCount($tips, $active);
								} else {
									$results = Tip::getTips($tips, $descending, $active, $pg, $rp);
								}
								echo RestUtils::sendResponse(200, json_encode($results));
							} else if(isset($_GET['popular'])){
								$results = Tip::getPopular();
								echo RestUtils::sendResponse(200, json_encode($results));
							}
						break;
					}
				} else {
					if(isset($_GET['count'])){
						$results = Tip::getAllCount($active);
					} else {
						$results = Tip::getAll($descending, $active, $pg, $rp);
					}
					if($results){
						echo RestUtils::sendResponse(200, json_encode($results));
					}
				}
			}
		break;
		case 'comment':
			if($args && isset($args['id'])){
				$comment = new Comment($args['id']);
				if($comment->uid != 0){
					echo RestUtils::sendResponse(200, json_encode($comment));
				} else {
					echo RestUtils::sendResponse(400, '');
				}
			} else {
				if(isset($action)){
					switch($action){
						case 'search':
						break;
					}
				}
			}
		break;
		case 'member':
			if($key){
				if($id = Member::key_exists($key)){
					$ass = Association::getByUser($id);
					foreach($ass as $a){
						if($a['type'] == 'member'){
							$member = new Member($a['id']);
							echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','member'=>$member)));
						}
					}			
				} else {
					echo RestUtils::sendResponse(400, '');
				}
			} else {
				if(isset($action)){
					switch($action){
						case 'search':
							if(isset($_GET['uid'])){
								$member = Object::get($_GET['uid']);
								if($member instanceOf Member){
									echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','member'=>$member)));
								} else {
									echo RestUtils::sendResponse(400, '');
								}				
							}
						break;
					}
				}
			}
		break;
	endswitch;
	