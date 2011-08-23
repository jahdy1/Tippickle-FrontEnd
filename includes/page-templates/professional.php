<?php echo Entity::getAddLink('professional');?>
<h1><?php echo $professional->get('job_title')?></h1>
<?php if(uid() != $professional->uid)echo Following::link(uid(), $professional);?>
<?php reviews_html($professional);?>
<?php var_dump($professional)?>
