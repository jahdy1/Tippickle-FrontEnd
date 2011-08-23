<div id="actions-widget" class="widget">
<h1>Activities</h1>
<a href="#" class="more-activities">All Activites</a>
<?php
// number of actions to show
if(!isset($show)) $show = 6;
$args = array('entity'=>$entity);
$array = Action::getAll($entity->uid,'actor',true,1,$show);
$template = BJL.DS.'includes'.DS.'list-templates'.DS.'actions-view.php';
include BJL.DS.'includes'.DS.'list.php';
?>
</div><!--/actions-widget-->