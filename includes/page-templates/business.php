<?php echo Entity::getAddLink('business');?>
<h1><?php echo $business->getName();?></h1>
<span class="claims"><a href="#">Claim this listing</a> | <a href="#">Report incorrect info</a><?php if(uid() != $business->uid)echo Following::link(uid(), $business, ' | ', '');?></span>
<div class="rating">Rating: <span class="num"><?php echo $business->get('rating_score')?></span>%</div>
<p class="address"><?php echo $business->get('address');?>,
	<span class="city-state"><?php echo UI::location($business->get('city'),$business->get('state'),$business->get('zip')) . ' ' . $business->get('zip');?> </span>
  <a href="#">(map)</a>
</p>

<p class="phone"><?php echo UI::format_phone($business->get('phone1'))?></p>
<p class="fax phone"><?php echo UI::format_phone($business->get('fax'))?></p>
<?php if($business->get('business_email') != ''):?>
<p class="email"><a href="mailto:<?php echo $business->get('business_email');?>"><?php echo $business->get('business_email');?></a></p>
<?php endif;?>
<p class="website"><strong>Website:</strong> <a href="<?php echo UI::url($business->get('url'));?>" target="_blank"><?php echo $business->get('url');?></a></p>
<?php if($business->get('hours') != ''){?>
<div id="hours" class="section">
<h2>Hours of Operation</h2>
<?php echo $business->get('hours');?>
</div><!--/hours-->
<?php }?>
<div id="desc" class="section">
<h2>Company Description</h2>
<?php echo $business->get('description');?>
</div><!--/desc-->
<?php if($business->get('bio') != ''){?>
<div id="bio" class="section">
<h2>Company Origin</h2>
<?php echo $business->get('bio');?>
</div><!--/bio-->
<?php }?>
<?php if($business->get('social') != ''){?>
<div id="social-center" class="section">
<h2>Connect</h2>
</div><!--/social-center-->
<?php }

if(logged_in() && isset($me) && $me instanceof User && $me->isOwner($business)){?>

    	<div class="section admin-section">
      <?php admin_only();?>
      	<h2>Target Interests</h2>
        <p>Individuals and/or businesses that use your products and services are likely interested in...</p>
        <?php $interests = $business->getInterests();
				foreach($interests as $i => $interest) {
					echo Interest::link($interest['interest']);
					if($i < count($interests)-1) echo ', ';
				}?>
      	<form method="post" action="">
        <!--<label for="interest_list">Interests: </label>-->
        <input type="text" name="interest_list" />
        <p class="instructions">Submit a comma seperated list of interests</p>
        <input type="submit" value="add">
        </form>
      </div><!--/section-->      
      <?php }?>

<?php reviews_html($business);?>
<?php //var_dump($business)?>