<?php 
$uids = array();
if($ents = Following::isFollowing(uid())){
	//var_dump($ents);
	foreach($ents as $ent){
		$uids[] = $ent['target_uid'];
	}
}

if(!empty($uids)) {
?>
<div id="watch-widget" class="widget">
<h1>My Watch List</h1>

<?php 
$show = 10;
$array = Action::getAll($uids,'actor',true,1,$show);
$template = BJL.DS.'includes'.DS.'list-templates'.DS.'watches-view.php';
include BJL.DS.'includes'.DS.'list.php';
?>

</div><!--/watch-widget-->	
<?php   
}
?>

