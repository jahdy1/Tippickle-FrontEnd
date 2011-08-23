<?php

global $messages;

if(isset($_GET['rsvp']) && is_numeric($_GET['rsvp'])){
	$the_event = Object::get($_GET['rsvp']);
	if(RSVP::add($the_event, Object::get(uid()))) $messages['event'] = 'You have RSVPed to ' . $the_event->displayName();
}

if(isset($_GET['unrsvp']) && is_numeric($_GET['unrsvp'])){
	$the_event = Object::get($_GET['unrsvp']);
	if(RSVP::remove($the_event, Object::get(uid()))) $messages['event'] = 'You have cancelled your RSVP to ' . $the_event->displayName();
}

if(isset($_GET['follow']) && is_numeric($_GET['follow'])){
	$target = Object::get($_GET['follow']);
	if(Following::add(Object::get(uid()), $target)) $messages['general'] = 'You are now following ' . $target->displayName();
}

if(isset($_GET['unfollow']) && is_numeric($_GET['unfollow'])){
	$target = Object::get($_GET['unfollow']);
	if(Following::remove(Object::get(uid()), $target)) $messages['general'] = 'You have stopped following ' . $target->displayName();
}

if(isset($_GET['login_as']) && is_numeric($_GET['login_as']) && local()){
	$target = Object::get($_GET['login_as']);
	Session::login_user($target->getID());
}

if(isset($_GET['add_interest'])){
	$actor = Object::get(uid());
	Interest::add($actor, $_GET['add_interest']);
}

if(isset($_GET['remove_interest'])){
	$actor = Object::get(uid());
	Interest::remove($actor, $_GET['remove_interest']);
}

if(isset($_POST['interest_list']) && !empty($_POST['interest_list']) && logged_in()) {
	$interests = $_POST['interest_list'];
	$list = explode(',',$interests);
	$array = array();
	foreach($list as $interest){
		$array[] = trim($interest);
	}
	$actor = Object::get(uid());
	$actor->setInterests($array);
}
