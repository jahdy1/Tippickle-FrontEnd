<?php echo Entity::getAddLink('event'); ?>
<h1><?php echo $event->getName()?></h1>
<h4><?php echo date('l', strtotime($event->get('start_datetime')))?> <?php echo $event->dates()?> <a href="">(Add to calendar)</a></h4>

<p class="venue-name">
<?php if($event->get('venue_url') != ''){  ?><a href="<?php echo UI::url($event->get('venue_url'));?>"><?php }?>
<?php echo $event->get('venue')?>
<?php if($event->get('venue_url') != ''){  ?></a><?php }?>
</p>
<span><?php echo $event->get('city') . ', ' . strtoupper($event->get('state'))?></span> <a href="#">(map)</a>
<div class="event-links"><?php echo $event->rsvp_link(uid(),'',' | '); echo Following::link(uid(), $event, '', ' | ');?><a href="#">Invite a Friend</a> | <a href="#">Like</a>
</div><!--/links-->
<div id="overview" class="section">
<h2>Overview</h2>
<?php if($event->get('highlights') != ''){?>
<h3>Highlights</h3>
<div class="highlights"><?php echo $event->getHighlights(); ?></div><!--/highlights-->
<?php } ?>
<?php if($event->get('description') != ''){?>
<h3>Description</h3>
<p class="description"><?php echo $event->get('description'); ?></p>
<?php } ?>
<?php if($event->get('event_url') != ''){?>
<p>Visit the event website for <a href="<?php echo UI::url($event->get('event_url'))?>" target="_blank"><?php echo $event->get('title') ?> for more information.</a></p>
<?php } ?>
</div><!--/overview-->
<div id="details" class="section">
<h2>Event Details</h2>
<table>
<?php $datapoints = array('address','event_url','contact_phone','type_id','admission','contact_name');?>
<?php foreach($datapoints as $dp){ ?>
<tr>
	<td class="labels"><strong><?php echo Form::getFieldName('event',$dp);?></strong>
  </td>
  <td>
  <?php 
	switch($dp):
		case 'contact_phone': $dpdata = UI::format_phone($event->get($dp));
		break;
		default:
			$dpdata = $dpdata = $event->get($dp);
		break;
	endswitch;
	echo $dpdata;
	?>
  </td>
</tr>
<?php } ?>
</table>
</div><!--/details-->
<?php reviews_html($event);?>
<?php //var_dump($event)'?>