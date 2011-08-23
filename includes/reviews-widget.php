<div id="reviews-widget">
<?php if(logged_in()){?>
<h1>Reviews</h1>
<?php if(isset($_POST) && !empty($_POST['review'])){Review::add($_POST);}?>
<form action="" method="post">
<table>
<tr>
<td>Posted by <span class="name"><?php echo displayName();?></span></td>
<td>
<label for="actor_anonymous">Post Anonymously</label>
<select name="actor_anonymous">
	<option value="0">no</option>
	<option value="1">yes</option>
</select>
</td>
</tr>
<tr>
<td><label for="rating">Rate this <?php echo ucwords($entity->getType())?></label></td>
<td>
<select name="rating">
	<?php for($i = 1; $i < 11; $i++){?><option value="<?php echo $i/10?>"><?php echo $i?></option><?php }?>
</select>
</td>
</tr>
<tr>
<td valign="top"><label for="review">Review</label></td>
<td><textarea name="review"></textarea></td>
</tr>
</table>
<input type="hidden" name="date_added" value="<?php echo date(DATETIME_INSERT_FORMAT);?>" />
<input type="hidden" name="actor_uid" value="<?php if(isBusiness()) echo businessUID(); else if(isMember()) echo memberUID();?>" />
<input type="hidden" name="actor_name" value="<?php echo displayName();?>" />
<input type="hidden" name="target_uid" value="<?php echo $entity->uid?>" />
<input type="hidden" name="target_name" value="<?php echo $entity->getName()?>" />
<input type="hidden" name="active" value="1" />
<input type="submit" value="post review" />
</form>
<?php }?>
<div class="review-list-area">
<?php if($reviews = $entity->getReviews()){
	if(!empty($reviews)){?>
	<h3>Recent Reviews</h3>
  <a href="#" class="more-reviews">See all reviews for this <?php echo ucwords($entity->getType())?></a>
	<ul class="review-list">
  <?php
	$i = 1;
	foreach($reviews as $review){?>
		<li>
    <p class="byline">By <strong><?php if($review['actor_anonymous'] == 0) echo $review['actor_name']; else echo 'Anonymous';?></strong> on <span class="date"><?php echo date(DATE_FORMAT, strtotime($review['date_added']))?> at <?php echo date(TIME_FORMAT, strtotime($review['date_added']))?></span></p>
    <p class="review"><?php echo '<strong>' . $i . '.</strong> ' . stripslashes($review['review']); $i++;?></p>
    <p class="bottom-links"><a href="#">This was helpful</a> | <a href="#">Report this review</a></p>
    </li>
	<?php }
?>	
	</ul>
<?php } else { ?>
<p>Be the first to write a review.</p>
<?php }
}?>
</div><!--/review-list-area-->
</div><!--/reviews-widget-->