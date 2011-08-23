<?php

if ( !session_id() )
add_action( 'init', 'session_start' );

if(class_exists('Memcache')){
	$memcache = new Memcache();
	$memcache->addServer('localhost');
	if(isset($_GET['flush'])) $memcache->flush();
}

function root(){
	return dirname(__FILE__);
}

function me(){
	if(class_exists('Object'))return Object::get(uid());
}

if(!isset($me)) $me = me();

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);

define('BJL',root());

include BJL.DS.'includes'.DS.'setup'.DS.'lang'.DS.'en.php';

function logged_in(){
	return Session::logged_in();
}

function isBusiness(){
	return Session::isBusiness();
}

function businessID(){
	return $_SESSION[Session::session_var_name()]['business'][0]['id'];
}

function businessUID(){
	return $_SESSION[Session::session_var_name()]['business'][0]['uid'];
}

function isProfessional(){
	return Session::isProfessional();
}

function isMember(){
	return Session::isMember();
}

function memberID(){
	return $_SESSION[Session::session_var_name()]['member']['id'];
}

function memberUID(){
	return $_SESSION[Session::session_var_name()]['member']['uid'];
}

function businessName(){
	return Session::businessName();
}

function memberName(){
	return Session::memberName();
}

function getNames(){
	return Session::getNames();
}

function displayName(){
	return Session::displayName();
}

function phone($phone_number){
	return Util::phone($phone_number);
}

function event_times($el, $return = 'output', $theme = 'list'){
	$details = Event::getDates($el['start_datetime'],$el['end_datetime']);
	return $details[$return];
}

function reviews_html(Entity $entity){
	include dirname(__FILE__) . DS . 'includes' . DS . 'reviews-widget.php';
}

function actions_html(Entity $entity){
	include dirname(__FILE__) . DS . 'includes' . DS . 'actions-widget.php';
}

function uid(){
	if(isBusiness()) return businessUID(); else if(isMember()) return memberUID();
}

function profile_link(){
	if(isBusiness()){
		return $_SESSION[Session::session_var_name()]['business'][0]['permalink'];
	} else if(isMember()){
		return $_SESSION[Session::session_var_name()]['member']['permalink'];
	}
}


//Function to create a string of elapsed time differences
//
//USAGE: string myDate( int Unix_Epoch_Seconds [, bool AllValues ] )
//RETURNS: A string of the elapsed time relative to when the function is
//    called. See examples for samples.
//DEPENDENCIES: Will use IsPlural, if available to handle pluralization.
//NOTES: Does not handle future dates at all, it will break and return 
//    "0 seconds". $AllValues allows one to include more time differences
//    in the string. Change "$AllValues=true" to "$AllValues=false" to
//    modifiy the default behavior.
/*******************************  EXAMPLES  *******************************
    
<?php
$time_to_use = strtotime("-1 year -2 months -3 days");
echo date('r', $time_to_use) . "\n";
echo myDate($time_to_use) . "\n";
echo myDate($time_to_use, false) . "\n";
?>
    Sample results:

Tue, 04 Dec 2007 00:18:28 -0600
1 year, 2 months, 1 week, 4 days
1 year
***************************************************************************/
function myDate( $time, $AllValues=true )
{
		$time = strtotime($time);
    //The elapsed amount of time in seconds (integers only please!)
    $elapsed = time() - floor($time);
    //Is there any real difference?
    if ($elapsed < 1) { return '0 seconds'; }
    //Setup an array of all possible time differences to check against
    $times = array (
        12 * 30 * 24 * 60 * 60  =>  'year',
        30 * 24 * 60 * 60       =>  'month',
        07 * 24 * 60 * 60       =>  'week',
        24 * 60 * 60            =>  'day',
        60 * 60                 =>  'hour',
        60                      =>  'minute',
        1                       =>  'second' );
    //Setup a return string
    $returned = '';
    //Loop through all of the time "constants"
    foreach ($times AS $seconds => $string)
    {
        //Get the difference
        $difference = floor($elapsed / $seconds);
        //Is there an actual (positive) difference?
        if ($difference >= 1)
        {
            //Add this difference to the return string. Will use a 
            //  pluralization sub-function if available. Modify as desired.
            if (function_exists('IsPlural'))
            { $returned .= " $difference " . IsPlural($difference, $string) . ","; }
            else
            { $returned .= " $difference $string" . ($difference > 1 ? 's' : '') . ','; }
            //Should we continue adding all possible differences?
            if (!$AllValues) { break; }
            //Subtract this difference from the total elapsed for the next loop
            $elapsed -= $difference * $seconds;
        }
    }
    //Strip the first space and final comma from the string before returning it
    return substr($returned, 1, -1) . ' ago';
}

function isOwner($uid){
	if(logged_in()){
		foreach($_SESSION[Session::session_var_name()]['associations'] as $entity){
			if($entity['unique_id'] == $uid) return true;
		}
	}
	return false;
}

function isAdmin($num = 8){
	return Session::isAdmin($num);
}

function options($option = NULL){
	return Session::options($option);
}

function last_day_of_the_month(){
	return date('F j, Y', strtotime('next month')-60*60*24);
}

function get_weather_condition_image($condition,$image = NULL){
	$image = array(1=>'Clouds.png',
								 2=>'Clouds_Moon.png',
								 3=>'Clouds_Sunny.png',
								 4=>'Clouds_Windy.png',
								 5=>'Moon.png',
								 6=>'Moon_Fog.png',
								 7=>'Stormy_Lightning.png',
								 8=>'Stormy_Rain.png',
								 9=>'Stormy_Rain_Hail.png',
								 10=>'Stormy_Rain_Lightning.png',
								 11=>'Sunny.png',
								 12=>'Windy.png',
								 13=>'DayMostlyCloudy.png',
								 14=>'NightMostlyCloudy.png',
								 );
	$time_when_dark = '7pm';
	$tod = date('ga') >= $time_when_dark ? 'night':'day';
	switch(strtolower($condition)){
		case 'thunderstorm': 
			return $image[10];
		break;
		case 'heavyrain': 
			return $image[8];
		break;
		case 'overcast': 
			return $image[1];
		break;
		case 'partlycloudy': 
			if($tod == 'day') return $image[3]; else return $image[2];
		break;
		case 'mostlycloudy':
			if($tod == 'day') return $image[13]; else return $image[14];
		break;
		case 'cloudy': 
			return $image[1];
		break;
		default: 
			if($tod == 'day') return $image[11]; else return $image[5];
		break;
	}
}

function get_signup_link(){
}

function admin_only(){
	$output = '';
	$output .= '<span class="admin-only">';
	$output .= 'Admin Only';
	$output .= '</span>';
	echo $output;
}