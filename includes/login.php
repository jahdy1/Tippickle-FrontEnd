<div id="login-form">
<?php 
if(Session::login_attempted()) {
	if($id = Session::login_authenticate()){
		Session::login_user($id);
	} else {
		Session::logout();
		echo '<p>Username and password do not match</p>';
	}
}

if(isset($_GET['signout'])) Session::logout();

?>

<?php if(!Session::logged_in()):?>
<form action="" method="post" name="bjl_login">
<input type="text" name="bjl_login_username"/>
<input type="password" name="bjl_login_password"/>
<input type="submit" value="login"/>
</form>
<?php else:?>
Welcome <?php echo displayName();?>, Not you? <a href="?signout">Signout</a>
<?php endif;?>
</div><!--/login-form-->

