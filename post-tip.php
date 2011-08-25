<?php
/*
Template Name: Post a Tip
*/
?>

<?php get_header(); ?>

<?php 

$_POST['active'] = 0;
if(logged_in()) {
	$_POST['actor_uid'] = uid();
	$_POST['actor_name'] = memberName();
	if($member = Object::get(uid))if($member->level > 1) $_POST['active'] = 1;
}

if(isset($_POST['actor_anonymous']) && $_POST['actor_anonymous'] == 1){
	$_POST['actor_uid'] = 0;
	$_POST['actor_name'] = '';	
}

$tagset = explode(',',$_POST['tags']);
$tags = array();
foreach($tagset as $tag){
	$tag = trim($tag);
	if($tag != ''){
		$tags[] = $tag;
	}
}
$_POST['tags'] = json_encode($tags);
$_POST['date_added'] = date(DATETIME_INSERT_FORMAT);
$_POST = array_merge($_POST, array('target_type'=>'tip'));

echo CURLER::post(get_bloginfo('url').'/api/tip/', $_POST);


?>



<form action="" method="post">

<input type="text" name="title">

<textarea name="tip">
</textarea>

<input type="text" name="tags">

<input type="submit" value="add tip"> 

</form>

<?php 

//$response = CURLER::get(get_bloginfo('url').'/api/tip/?target_args[id]=1');
$response = CURLER::get(get_bloginfo('url').'/api/tip/');
$response = (array)json_decode($response);
foreach($response as $entry){
	var_dump($entry);
}

?>

<?php get_footer(); ?>