<?php
/**
 * Template Name: Tippickle API
 *
 */
 
/*

GET		/api/tip/ : Get all tips
POST 	/api/tip/ : Add a tip
PUT 	/api/tip/{resource_id}/ : Update an existing tip


*/
 
$entity = get_query_var('entity') != '' ?get_query_var('entity'):false;
$id = false;
$query = false;


if(get_query_var('mixed') != ''){
	if(is_numeric(get_query_var('mixed'))) $id = get_query_var('mixed'); else $action = get_query_var('mixed');
}

$data = RestUtils::processRequest();

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
