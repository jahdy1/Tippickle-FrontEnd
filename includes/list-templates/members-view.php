<li class="clearfix">
<div class="thumb"></div>
<h1><a href="<?php echo Member::getPermalink(Member::$permalink_root, $el['id'])?>"><?php echo $el['display_name']; ?></a>
<?php if(logged_in() && isAdmin()){?><span class="edit">
- <a href="<?php echo Entity::getEditLink('member',$el['id'])?>">edit</a>
</span><?php }?>
</h1>
<p><?php echo UI::location(NULL, NULL, $el['zip']);?></p>
<?php if(local()) {?><a href="?login_as=<?php echo Object::uid('member',$el['id'])?>">log in as</a><?php }?>
</li>