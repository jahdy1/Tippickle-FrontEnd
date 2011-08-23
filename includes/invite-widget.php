<?php global $stype;?>
<?php
if(isset($_POST)){
	if((isset($_POST['email_addresses']) && !empty($_POST['email_addresses'])) && isset($_POST['check'])){
		$emails = explode(',',$_POST['email_addresses']);
		if(count($emails) > 0) $valid_addresses = array();
		foreach($emails as $email){
			$email = trim($email);
			if(is_email($email)) $valid_addresses[] = $email;
		}
		$errors = array();
		if(!empty($valid_addresses)){
			$data = array();
			$data['date_added'] = date(DATETIME_INSERT_FORMAT);
			$data['invitation_text'] = invite_text($stype);
			if(logged_in()){
				if(isBusiness()) $data['actor_uid'] = businessUID();
				else if(isMember()) $data['actor_uid'] = memberUID();
				$data['actor_name'] = displayName();
			} else {
				if(empty($_POST['host_name']) || empty($_POST['host_email'])){
					$errors[] = ERR01;
				} else {
					$data['actor_name'] = $_POST['host_name'];
					$data['actor_email'] = $_POST['host_email'];
				}
			}
			foreach($valid_addresses as $address){
				$data['token'] = md5($address.date($data['date_added']));
				$data['target_email'] = $address;
				Invitation::add($data);
			}
		}
	}
}
?>


<div id="invite-widget" class="widget">
	<h1>Invite a friend</h1>
  <p>Don't keep the awesomeness of golive.com to yourself!</p>
  <p>Invite your friends to get involved today.</p>
	<form action="" method="post">
  <table>
  <?php if(!logged_in()){?>
  	<tr><td>
    <label for="host_name">Name: </label><input name="host_name" type="text"/>
    </td></tr>
  	<tr><td>
  	<label for="host_email">Email: </label><input name="host_email" type="text"/>
    </td></tr>
  <?php }?>  
  	<tr><td>
  	<textarea name="email_addresses"></textarea>
    </td></tr>
  	<tr><td>
  	<input name="check" type="hidden"></textarea>
    </td></tr>
  	<tr><td>
    <span class="instructions">Type email addresses seperated by commas</span>
    <input type="submit" value="Send Invites">
    </td></tr>
  	<tr><td>
  </table>
  </form>
</div>