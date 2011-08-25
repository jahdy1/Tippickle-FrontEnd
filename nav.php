<ul id="main-navigation" class="clearfix">
<?php 
if(isAdmin(10))
foreach(array('drop','setup','clear','debug','flush','backup') as $option){ ?>
	<li><a href="?<?php echo $option?>"><?php echo ucwords($option);?></a></li>
<?php } ?>
</ul>