<li>
<div>
<!--<p class="rank">Rank #00</p>-->
</div>
<h1>
<?php if(isset($el['member_level']) && is_numeric($el['member_level']) && (int)$el['member_level'] >= 2){?><a href="<?php echo Business::getPermalink(Business::$permalink_root, $el['db_friendly_url'])?>"><?php echo $el['name']; ?></a><?php } else {?>
<?php echo $el['name']; }?>
<?php if((logged_in() && isOwner(Object::uid('business',$el['id']))) || isAdmin()){?><span class="edit"> - <a href="<?php echo Entity::getEditLink('business',$el['id'])?>">edit</a></span><?php }?>
</h1>
<p class="address"><?php echo $el['address'] . ', ' . UI::location($el['city'],strtoupper($el['state']),$el['zip'])?></p>
<p class="phone"><?php echo phone($el['phone1']);?></p>
<?php if(isset($el['category']) && is_numeric($el['category']) && (int)$el['category'] != 0){?>
<p class="category"><?php echo $el['category']?></p> <?php }?>
<?php if(local()) {?><a href="?login_as=<?php echo Object::uid('business',$el['id'])?>">log in as</a><?php }?>
</li>