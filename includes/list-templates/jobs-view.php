<li>
<h1><a href="<?php echo Job::getPermalink(Job::$permalink_root, $el['id'])?>"><?php echo $el['job_title']; ?></a>
<?php if(logged_in() && isAdmin()){?><span class="edit">
 - <a href="<?php echo Entity::getEditLink('job',$el['id'])?>">edit</a>
</span><?php }?>
</h1>
<h4><?php echo $el['company_name'];?> - <span class="location"><?php echo UI::location($el['city'],$el['state'],$el['zip']);?></span></h4>
<div class="desc">
<?php 
$words_length = 30;
$truncate = false;
$desc = explode(' ',$el['job_description']);
if(count($desc) > $length) $truncate = true;
if($truncate) {
	$output = '';
	foreach($desc as $i => $word){
		if($i+1 <= $words_length){
			$output .= $word . ' ';
		}
	}
	echo trim($output) . '...';
} else {
	echo $el['job_description'];
}
?>
</div><!--/desc-->
<p class="meta-and-links">
Added on <span class="date"><?php echo date(DATE_FORMAT, strtotime($el['date_added'])) ?></span>
</p><!--/meta-and-links-->
</li>