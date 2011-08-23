<li class="action">
<?php
$target_obj = Object::get($el['target_uid']);
$actor = '%actor%';
$target = '%target%';
$date = '%date%';
$output = '';
switch($el['action']){
	case 'rate': $output .= '<span class="date">' . $date . '</span>' . $actor . ' rated ' . $target;
	break;
	case 'review': $output .= '<span class="date">' . $date . '</span>' . $actor . ' posted a review on ' . $target;
	break;
	case 'rsvp': $output .= '<span class="date">' . $date . '</span>' . $actor . ' has RSVPed to ' . $target;
	break;
	case 'unrsvp': $output .= '<span class="date">' . $date . '</span>' . $actor . ' is no longer RSVPed to ' . $target;
	break;
	case 'thought': $output .= '<span class="date">' . $date . '</span>' . $actor . ' thinks ' . $target;
	break;
	case 'follow': $output .= '<span class="date">' . $date . '</span>' . $actor . ' is now following ' . $target;
	break;
	case 'unfollow': $output .= '<span class="date">' . $date . '</span>' . $actor . ' has unfollowed ' . $target;
	break;
	case 'comment': $output .= '<span class="date">' . $date . '</span>' . $actor . ' commented on ' . $target;
	break;
	case 'watch': $output .= '<span class="date">' . $date . '</span>' . $actor . ' is watching ' . $target;
	break;
	case 'apply': $output .= '<span class="date">' . $date . '</span>' . $actor . ' applied to ' . $target;
	break;
	case 'bid': $output .= '<span class="date">' . $date . '</span>' . $actor . ' bidded on ' . $target;
	break;
}
$output = str_replace($actor, $entity->displayName(),$output);
$output = str_replace($date, date(DATE_FORMAT, strtotime($el['date'])),$output);
if(!in_array($el['action'],array('thought')))$output = str_replace($target, '<a href="'.$target_obj->permalink().'">'.$target.'</a>', $output);
if($el['action'] == 'thought')$output = str_replace($target,'"'.$target.'"', $output);
$output = str_replace($target,$target_obj->displayName(), $output);
echo $output;
?>
</li>