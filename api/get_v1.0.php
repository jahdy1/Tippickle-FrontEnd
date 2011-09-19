<?php

	extract($data->getRequestVars());

	$args = false;
	
	if(isset($target_args) && !empty($target_args)){
		$args = $target_args;
	}
	
	// $resultset = array('status'=>NULL,'recordCount'=>NULL,'results'=>NULL);
	
	$pg = isset($_GET['pg'])?$_GET['pg']:false;
	$rp = isset($_GET['rp'])?$_GET['rp']:10;
	$popular_action = isset($_GET['popular_action'])?$_GET['popular_action']:NULL;
	$descending = isset($_GET['asc'])? false: true;
	$active = !isset($_GET['active'])? false: true;
	$host_id = API_READ == 'private'? APIUSER:NULL;
	
	switch($target_type):
		case 'tip':
			if($args && isset($args['id'])){
				$tip = new Tip($args['id']);
				if($tip->uid != 0){
					if((API_READ == 'private' && $tip->host_id == APIUSER) || API_READ == 'public'){
						$resultset = array();
						$resultset['status'] = 200;
						$resultset['recordCount'] = 1;
						$resultset['results'] = $tip;
						echo RestUtils::sendResponse($resultset['status'], json_encode($resultset));
						exit;
					} else {
						echo RestUtils::sendResponse(401, '');
						exit;
					}
				} else {
					echo RestUtils::sendResponse(400, '');
					exit;
				}
			} else {
				if(isset($action)){
					switch($action){
						case 'search':
							if(isset($_GET['tag'])){
								if(isset($_GET['count'])){
									$results = Tip::getSimilarTipsCount(urldecode($_GET['tag']), $host_id);
								} else {
									$results = Tip::getSimilarTips(urldecode($_GET['tag']), $pg, $rp, $host_id);
									$resultset = array();
									$resultset['status'] = 200;
									$resultset['recordCount'] = Tip::getSimilarTipsCount(urldecode($_GET['tag']), $host_id);
									$resultset['results'] = $results;
									$results = $resultset;
								}
								echo RestUtils::sendResponse(200, json_encode($results));
								exit;
							} else if(isset($_GET['tip_ids'])){
								$tips = explode(',',$_GET['tip_ids']);
								if(isset($_GET['count'])){
									$results = Tip::getTipsCount($tips, $active, $host_id);
								} else {
									//echo 'yay2';
									$results = Tip::getTips($tips, $descending, $active, $pg, $rp, $host_id);
									$resultset = array();
									$resultset['status'] = 200;
									$resultset['recordCount'] = Tip::getTipsCount($tips, $active, $host_id);
									$resultset['results'] = $results;
									$results = $resultset;
								}
								echo RestUtils::sendResponse(200, json_encode($results));
								exit;
							} else if(isset($_GET['popular'])){
								$results = Tip::getPopular($popular_action, $descending, $active, $pg, $rp, $host_id);
									$resultset = array();
									$resultset['status'] = 200;
									$resultset['recordCount'] = count($results);
									$resultset['results'] = $results;
									$results = $resultset;
								echo RestUtils::sendResponse(200, json_encode($results));
								exit;
							}
						break;
					}
				} else {
					if(isset($_GET['count'])){
						$results = Tip::getAllCount($active, $host_id);
					} else {
						$results = Tip::getAll($descending, $active, $pg, $rp, $host_id);
						$resultset = array();
						$resultset['status'] = 200;
						$resultset['recordCount'] = Tip::getAllCount($active, $host_id);
						$resultset['results'] = $results;
						$results = $resultset;
					}
					if($results){
						echo RestUtils::sendResponse(200, json_encode($results));
						exit;
					}
				}
			}
		break;
		case 'comment':
			if($args && isset($args['id'])){
				$comment = new Comment($args['id']);
				if($comment->uid != 0){
					echo RestUtils::sendResponse(200, json_encode($comment));
					exit;
				} else {
					echo RestUtils::sendResponse(400, '');
					exit;
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
							echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','recordCount'=>1,'results'=>$member)));
							exit;
						}
					}			
				} else {
					echo RestUtils::sendResponse(400, '');
					exit;
				}
			} elseif($id) {
				$member = new Member($id);
				echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','recordCount'=>1,'results'=>$member)));
				exit;				
			} else {
				if(isset($action)){
					switch($action){
						case 'search':
							if(isset($_GET['uid'])){
								$member = Object::get($_GET['uid']);
								if($member instanceOf Member){
									echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','recordCount'=>1,'results'=>$member)));
									exit;
								} else {
									echo RestUtils::sendResponse(400, '');
									exit;
								}
							}
							if(isset($_GET['get_id'])){
								$user = APIUser::getByKey(APIKEY);
								if(isset($user->email)){
									echo RestUtils::sendResponse(200, json_encode(array('status'=>'ok','recordCount'=>1,'results'=>$user->id)));
									exit;
								} else {
									echo RestUtils::sendResponse(400, '');
									exit;
								}
							}
						break;
					}
				}
			}
		break;
	endswitch;
	