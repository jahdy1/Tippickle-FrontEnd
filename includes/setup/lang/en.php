<? 
function invite_text($type, $host_name = '{host}',$user_name = '{name}', $user_email = '{email}'){
	switch($type):
		default: $output = "
    <p>Hello ".$user_name.", </p>
    <p>You've been invited to GoTCLive.com by ".$host_name.".  GoTCLive.com is a community centric resource that allows residences and businesses to find out the lastest in news, weather, lifestyle, and events in your area.</p>
    <p>Signing up takes less than 5 minutes and you're on your way to exploring your community.  Click on the link below to sign up for GoTCLive.com now!</p>";
		break;
	endswitch;
	return $output;
}


define('MEMBER_INVITATION', invite_text('member'));
define('ERR01','Either login or enter name and email');