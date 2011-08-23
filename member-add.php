<?php
/**
 * Template Name: Tippickle Member Add
 *
 */
?> 	

<?php 
$stype = 'member';
?>
<?php 
$form = new Form($stype,NULL,1);
//echo $form->build();
if($results = $form->process()){
	if(!empty($results)){
		if(is_numeric($results)){
			$obj_id = $results;
			$obj = Object::get(Object::uid($stype,$obj_id));
			if(logged_in())Session::logout();
			Session::login_user($obj->get('u_id'));
		} elseif(is_array($results)) {
			$errors = $results;
		}
	}
}
?>

<?php get_header(); ?>

<div class="main-content clearfix" id="member-content">


<form action="" method="post">
<div id="setup-member" class="setup-page">
  <?php if(isset($errors)){?>
  <div class="alerts-box">
  	<ul>
		<?php
		foreach($errors as $index => $error){
			if($index == 'required_not_set'){
				$rtn = '<li>The following fields have not been filled out: ';
				if(is_array($error))
				foreach($error as $fieldname => $field){
					$rtn .= $form->fieldName($fieldname)  . ', ';
				}
				$rtn = trim($rtn,', ').'</li>';
				echo $rtn;
			} else {
				$rtn = '<li>'.$error.'</li>';
			}}?>
    </ul>
  </div>
  <?php }?>
  <div class="section">
  <h2>Set up your account</h2>
  <table>
  	<tr>
    	<td class="label"><?php echo $form->label('username')?></td><td><?php echo $form->field('username')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('password')?></td><td><?php echo $form->field('password')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('email')?></td><td><?php echo $form->field('email')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('secret_question')?></td><td><?php echo $form->field('secret_question')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('secret_answer')?></td><td><?php echo $form->field('secret_answer')?></td>
    </tr>
  </table>
  </div><!--/section-->
  <div class="section">
  <h2>Tell us about yourself</h2>
  <table>
  	<tr>
    	<td class="label"><label for="first_name">First / Last Name<span class="required">*</span></label></td>
      <td><?php echo $form->field('first_name')?><?php echo $form->field('last_name')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('display_name')?></td><td><?php echo $form->field('display_name')?> (<a href="#">add custom</a>)</td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('gender')?></td><td><?php echo $form->field('gender')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('zip')?></td><td><?php echo $form->field('zip')?></td>
    </tr>
  	<tr>
    	<td class="label"><?php echo $form->label('dob')?></td><td><?php echo $form->field('dob')?></td>
    </tr>
  </table>
  </div><!--/section-->
</div><!--/setup-page-->
	<input type="submit" value="Sign Up Now">
</form>
</div><!--/main-content-->
<?php get_sidebar();?>
<?php get_footer(); ?>