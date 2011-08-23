<li class="clearfix">
<div class="content clearfix">
<?php if($el['level'] > 1){?><div class="thumb"></div><!--/thumb--><?php }?>
<h1>
<?php if($el['level'] > 1){?><a href="<?php echo Event::getPermalink(Event::$permalink_root, $el['db_friendly_url'])?>"><?php }?>
<?php echo $el['title']; ?>
<?php if($el['level'] > 1){?></a><?php }?>
<?php if((logged_in() && isOwner(Object::uid('event',$el['id']))) || isAdmin()){?>
<span class="edit"> - <a href="<?php echo Entity::getEditLink('event',$el['id'])?>">edit</a></span>
<?php }?>
</h1>
<?php echo event_times($el)?>
<p class="venue">
<?php 
$vurl = false;
if(!empty($el['venue_url'])){ $vurl = true;?>
<a href="<?php echo UI::url($el['venue_url'])?>">
<?php } ?>
<?php echo $el['venue']?>
<?php if($vurl) echo '</a>';?>
<?php if(!empty($el['venue_uid'])){
	$venue = Object::get($el['venue_uid']);
	//var_dump($venue);
?> - <a href="<?php echo $venue->permalink()?>">see profile</a><?php unset($venue); }?></p>
<p class="address"><?php echo UI::location($el['city'],strtoupper($el['state']),$el['zip']);?></p>
</div><!--/content-->
<?php if ($el['display_contact'] == 1 && $el['level'] > 1) { // show contact info?>
<div class="event-contact">
<h3>Contact Information</h3>
<?php if(!empty($el['contact_name'])){?><p class="contact_name">Name: <?php echo $el['contact_name'];?></p><?php }?>
<?php if(!empty($el['contact_phone'])){?><p class="phone">Phone: <?php echo phone($el['contact_phone']);?></p><?php }?>
<?php if(!empty($el['contact_email'])){?><p class="email">Email: <?php echo $el['contact_email'];?></p><?php }?>
</div><!--/event-contact-->
<?php }?>
<?php if(isset($el['type_id']) && is_numeric($el['type_id']) && (int)$el['type_id'] != 0){?>
<p class="category"><?php echo $el['type_id']?></p>
<?php }?>
<?php 
if($el['level'] > 1){
	$limit = 160;
	$len = strlen($el['description']);
	echo substr($el['description'],0,$limit);
	if($len > $limit) echo '...';
}
?>
</li>