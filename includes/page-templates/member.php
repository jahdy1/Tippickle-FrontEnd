<?php //echo Entity::getAddLink('member');?>
<h1><?php echo $member->displayName();?> - <span class="location"><?php echo UI::location(NULL, NULL, $member->get('zip'));?></span></h1>
<div id="tabs">
  <div id="tab1" class="clearfix">
    <div id="sidebar-left" class="clearfix">
      <div id="main-image" class="thumb image widget">
        <img src="#" style="background:#ccc;" width="130" height="90" />
      </div>
      <div class="widget">
        <h2>Interests</h2>
      </div><!--/widget-->
      <div class="widget">
        <h2>Inventory</h2>
      </div><!--/widget-->
      <div class="widget">
        <h2>Calendar</h2>
      </div><!--/widget-->
    </div><!--/sidebar-left-->
    <div id="center-panel">
    	<div class="section">
      <?php
      $profile_datapoints = array('name','dob','email','url','profession','business','bio');
			foreach($profile_datapoints as $field){
				switch($field){
					case 'name':
						if($member->getPref('show_name') == true) echo $member->getName();
					break;
					case 'dob': 
						if($member->dob()){
							if($member->getPref('show_dob') == true) {
								if($member->getPref('dob_format') != NULL) $date = date($member->getPref('df'), strtotime($member->dob()));
								else $date = date('F j, Y',strtotime($member->dob()));
								if($member->getPref('show_name') == true) echo ' - ';
								echo ' Born on ' . $date;
							}
						}
					break;
					case 'email':
						if($member->get('email') != ''){
							if($member->getPref('show_member_email') == true ) echo '<p>' . $member->get('email') . '</p>';
						}
					break;
					case 'url':
						if($member->get('url') != '') echo '<p><a href="'.UI::url($member->get('url')).'">' . UI::url($member->get('url')) . '</a></p>';
					break;
					case 'profession':
						if($professional_id = $member->isProfessional()){
							if(is_numeric($professional_id) && $professional_id != 0) $professional = Object::get($professional_id);echo '<p>Profession: '.$professional->get('job_title').' <a href="'.$professional->permalink().'">(see profile)</a></p>';
						}
					break;
					default:
						echo '<p>' . $member->get($field) . '</p>';
					break;
				}
			}
			if(uid() != $member->uid) echo Following::link(uid(), $member, '', '');
			?>
      </div><!--/section-->
    	<div class="section">
        <?php $show = 10; $entity = $member; include BJL.DS.'includes'.DS.'actions-widget.php';?>
      </div><!--/section-->
      <?php //$member->setSocial(array('facebook'=>'jahdy1'));?>
      <?php if($member->isSocial()){?>
    	<div class="section">
      	<h2>Social Connections</h2>
        <?php UI::socialBar($member->socialAccounts());?>
      </div><!--/section-->
      <?php } ?>
    	<div class="section">
      	<h2>Projects & Listings</h2>
      </div><!--/section-->
    	<div class="section">
      	<h2>Interests</h2>
        <?php $interests = $member->getInterests();
				foreach($interests as $i => $interest) {
					echo Interest::link($interest['interest']);
					if($i < count($interests)-1) echo ', ';
				}
				
      if(logged_in() && isset($me) && $me instanceof User && $me->isOwner($member)){?>
      	<form method="post" action="">
        <label for="interest_list">Interests: </label>
        <input type="text" name="interest_list" />
        <p class="instructions">submit a comma seperated list of interests</p>
        <input type="submit" value="add">
        </form>
      <?php }?>
      </div><!--/section-->      
    </div><!--/center-panel-->
  </div><!--/tab1-->
  <div id="tab2">
  </div><!--/tab2-->
</div><!--/tabs-->
<?php //var_dump($member);?>