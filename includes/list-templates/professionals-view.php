<li>
<h1><a href="<?php echo Professional::getPermalink(Professional::$permalink_root, $el['id'])?>"><?php echo $el['job_title']; ?></a>
<?php if(logged_in() && isAdmin()){?><span class="edit">
 - <a href="<?php echo Entity::getEditLink('professional',$el['id'])?>">edit</a>
</span><?php }?>
</h1>
<?php if(local()) {?><a href="?login_as=<?php echo Object::uid('professional',$el['id'])?>">log in as</a><?php }?>
</li>