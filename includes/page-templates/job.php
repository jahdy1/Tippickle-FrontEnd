<?php echo Entity::getAddLink('job');?>
<h1><?php echo $job->getName()?></h1>
<h3 class="company-name"><?php echo $job->get('company_name');?></h3>
<span class="byline">Posted on <span class="date"><?php echo date(DATE_FORMAT,strtotime($job->get('date_added')))?></span></span>
<div class="snapshot section">
<h2>Job Snapshot</h2>
<?php $dps = array('Location','Employee Type','Last Update','Duration','Start Date','End Date','Relocation Available','Telecommute Available','Compensation');?>
<table>
<?php 
$output = array();
foreach($dps as $dp){
	switch($dp):
		case 'Location': $output[$dp] =  $job->get('city') . ', ' . $job->get('state');
		break;
		case 'Employee Type': if($job->get('schedule') == 'fulltime') $output[$dp] = 'Full Time'; else $output[$dp] = 'Part Time';
		break;
		case 'Last Update': if(date(DATE_FORMAT, strtotime($job->get('date_updated'))) > date(DATE_FORMAT, strtotime($job->get('date_added')))) $output[$dp] = date(DATE_FORMAT, strtotime($job->get('date_updated'))); else $output[$dp] = date(DATE_FORMAT, strtotime($job->get('date_added')));
		break;
		case 'Duration': 
			$temp = false;
			if($job->get('length') == 'temp'){ $temp = true; $output[$dp] = 'Temporary';} else {$output[$dp] = 'Permanent';}
		break;
		case 'Start Date':
			if($job->get('start_date') == '0000-00-00 00:00:00') {
				$output[$dp] = 'OPEN';
			} else {
				$output[$dp] = date(DATE_FORMAT, strtotime($job->get('start_date')));
			}
		break;
		case 'End Date': if($temp && $job->get('end_date') != '0000-00-00 00:00:00') $output[$dp] = date(DATE_FORMAT, strtotime($job->get('end_date')));
		break;
		case 'Relocation Available': if($job->get('relocation_available') == 1) $output[$dp] = 'Yes'; else $output[$dp] = 'No';
		break;
		case 'Telecommute Available': if($job->get('telecommute') == 1) $output[$dp] = 'Yes'; else $output[$dp] = 'No';
		break;
		case 'Compensation': 
			if($job->get('salary_annual') != 0){
				$output[$dp] = UI::money($job->get('salary_annual')) . ' / year';
				$output[$dp] .= $job->get('negotiable') == 1? ' <span class="neg">(negotiable)</span>':'';
			} else if($job->get('salary_hourly') != '0.00'){
				$output[$dp] = UI::money($job->get('salary_hourly')) . ' / hour';
				$output[$dp] .= $job->get('negotiable') == 1? ' <span class="neg">(negotiable)</span>':'';
			}
		break;
	endswitch;
}
foreach($output as $name => $value){ ?>
	<tr>
  	<td class="labels"><strong><?php echo $name?>: </strong>
    </td>
    <td><?php echo $value?>
    </td>
  </tr>
<?php
}
?>
</table>
</div><!--/snapshot-->
<?php if($job->get('job_description') != ''){ ?>
<div class="desc section">
<h2>Description</h2>
<div class="copy">
<?php echo $job->get('job_description')?>
</div><!--/copy-->
</div><!--/desc-->
<?php }?>
<?php if($job->get('job_requirements') != ''){?>
<div class="requirements section">
<h2>Requirements</h2>
<div class="copy">
<?php echo $job->get('job_requirements')?>
</div><!--/copy-->
</div><!--/requirements-->
<?php }?>
<div class="share-interact">
<?php echo Following::link(uid(), $job);?>
<?php if(isProfessional()){ ?>
	 | <a href="#">Apply Now</a>
<?php } ?>
</div><!--/share-interact-->
<?php //var_dump($job)?>
