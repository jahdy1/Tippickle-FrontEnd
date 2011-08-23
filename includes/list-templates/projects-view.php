<li>
<h1><a href="<?php echo Project::getPermalink(Project::$permalink_root, $el['id'])?>"><?php echo $el['project_title']; ?></a>
<?php if(logged_in() && isAdmin()){?><span class="edit">
 - <a href="<?php echo Entity::getEditLink('project',$el['id'])?>">edit</a>
</span><?php }?>
</h1>
<?php 
$location = UI::location($el['project_city'],$el['project_state'],$el['project_zip']);
if (isset($location)){?>
<p class="meta"><?php echo $location?> | 
<?php 
if($el['compensation'] >= 1000) $comp = '$$$'; 
else if($el['compensation'] < 1000 && $el['compensation'] >= 500) $comp = '$$';
else if($el['compensation'] < 500) $comp = '$'; echo $comp;?>
</p>
<?php }?>
</li>