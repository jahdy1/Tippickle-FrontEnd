<?php echo Entity::getAddLink('project');?>
<h1><?php echo $project->displayName()?> - <?php echo UI::location($project->get('project_city'),$project->get('project_state'),$project->get('project_zip'))?></h1>
<p>Posted by <?php $ent = Object::get($project->get('submitter_uid'));?><a href="<?php echo $ent->permalink()?>"><?php echo $ent->displayName();?></a></p>
<span class="due-by">Due by <?php echo date(DATE_FORMAT, strtotime($project->get('date_due')))?></span>
<p><strong>Original Offer: </strong><?php echo UI::money($project->get('compensation'))?></p>
<p><strong>Best Offer: </strong></p>
<div class="desc">
<h3>Description</h3>
<?php echo $project->get('project_description')?>
</div><!--/desc-->
<?php echo Following::link(uid(), $project);?>
<div class="place-bid">
<h2>Make an Offer</h2>
<form action="" method="post">
<table>
<tr>
	<td><label for="amount">Amount: </label></td>
  <td>$<input type="text" name="amount"></td>
</tr>
<tr>
	<td><label for="more-info">More Information: <span class="optional">(optional)</span></label></td>
  <td><textarea name="more-info"></textarea></td>
</tr>
</table>
<input type="hidden" value="posted-project">
<input type="submit" value="Submit">
</form>
</div><!--/place-bid-->
<?php //var_dump($project);?>
