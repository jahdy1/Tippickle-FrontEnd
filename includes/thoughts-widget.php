<div id="thoughts-widget" class="widget">
<h1>Local Thoughts</h1>
<a href="#" class="more-thoughts">All Thoughts</a>
<?php if(logged_in()){
if(isset($_POST)  && !empty($_POST['thought'])){
	Thought::add($_POST);
}
?>
<p class="word-count"><span class="count">160</span> characters left</p>
<form action="" method="post">
<textarea name="thought"></textarea>
<input type="hidden" name="date_added" value="<?php echo date(DATETIME_INSERT_FORMAT)?>" />
<input type="hidden" name="actor_uid" value="<?php if(isBusiness()) echo businessUID(); else if(isMember()) echo memberUID();?>" />
<input type="submit" value="post thought">
</form>
<?php } else { ?>
	<a href="#">Log in</a> or <?php echo Entity::getAddLink('member', 'sign up');?> to add your thought!
<?php } 
				$array = Thought::getAll('date', true, 'active', 1, 4);
				$template = BJL.DS.'includes'.DS.'list-templates'.DS.'thought-view.php';
				include BJL.DS.'includes'.DS.'list.php';
				?>
</div><!--/thoughts-widget-->