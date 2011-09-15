<?php
/**
 * Template Name: Tippickle API
 *
 */
 
/*

GET			/api/tip/?api_key=XXXXX : Get all tips
GET			/api/tip/?pg=2&rp=20&api_key=XXXXX : Get tips on page 2 where results are 20 per page
GET			/api/tip/{resource_id}/?api_key=XXXXX : Get specified tip
GET			/api/tip/search/?tip_ids=2,3,10,11&pg=1&api_key=XXXXX : Get array of results were tip id equals either 2, 3, 10, or ll. Return only page 1
GET			/api/tip/search/?tag=NYC&pg=1&api_key=XXXXX : Get array of tips that share the tag 'NYC'. Return only page 1
GET			/api/tip/search/?tag=NYC&pg=1&active&api_key=XXXXX : Get array of tips that share the tag 'NYC' if tip is active. Return only page 1
GET			/api/tip/search/?tag=NYC&pg=1&asc&api_key=XXXXX : Get array of tips that share the tag 'NYC' in ascending order by date. Return only page 1
GET			/api/tip/search/?tag=NYC&count&api_key=XXXXX : Get count of this query
GET			/api/tip/search/?popular&api_key=XXXXX : Get list of popular tips
GET			/api/member/search/?uid=3&api_key=XXXXX : Get member with UID of 3
GET			/api/member/3/?api_key=XXXXX : Get member with ID of 3
POST 		/api/tip/?api_key=XXXXX : Add a tip
POST 		/api/rating/?api_key=XXXXX : Add a rating
POST 		/api/comment/?api_key=XXXXX : Add a comment
POST		/api/member/?api_key=XXXXX : Add a member
PUT 		/api/tip/{resource_id}/?api_key=XXXXX : Update an existing tip
DELETE 	/api/tip/{resource_id}/?api_key=XXXXX : Delete an existing tip

*/
 
$data = RestUtils::processRequest();

$req_data = $data->getRequestVars();

$authenticated = false;
if(isset($req_data['api_key'])){
	$user = APIUser::getByKey($req_data['api_key']);
	if($user->secret_key == $req_data['api_key']) $authenticated = true;
}

if($authenticated){

	$entity = get_query_var('entity') != '' ? get_query_var('entity'):false;
	$id = false;
	$query = false;
	
	if(get_query_var('mixed') != ''){
		if(is_numeric(get_query_var('mixed'))) $id = get_query_var('mixed'); else $action = get_query_var('mixed');
	}
	
	if($id && ($data->target_args == false  || !is_array($data->target_args) || !isset($data->target_args['id']))){
		$data->setRequestVars(array_merge($data->getRequestVars(), array('target_args'=>array('id'=>$id))));
	}
	
	
	if($entity) $data->target_type = $entity;
	
	switch(strtolower($data->getMethod()))
	{
		case 'get':
			$target_type = $data->target_type;
			include_once 'api/get_v1.0.php';
			break;
		case 'post':
			$target_type = $data->target_type;
			include_once 'api/post_v1.0.php';
			break;
		case 'put':
			$target_type = $data->target_type;
			include_once 'api/put_v1.0.php';
			break;
		case 'delete':
			$target_type = $data->target_type;
			include_once 'api/delete_v1.0.php';
			break;
	}
	
} else {
	echo RestUtils::sendResponse(401, '');
}