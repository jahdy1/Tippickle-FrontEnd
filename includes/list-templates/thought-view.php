<li class="thought clearfix">
<div class="thumb"></div><!--/thumb-->
<p class="actor"><?php if(!empty($el['actor_uid']))$actor = Object::get($el['actor_uid']); echo $actor->displayName();?> thinks...</p>
<p class="thought"><?php echo stripslashes($el['thought']);?></p>
<p class="date"><?php echo myDate($el['date_added'],false)?></p>
</li>