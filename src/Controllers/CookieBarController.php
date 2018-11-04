<?php

namespace StudioBonito\CookieBar;

use PageController;
use SilverStripe\Control\Cookie;
use SilverStripe\Control\Director;

class CookieBarController extends PageController
{
	const URLSegment = "cookiebar";

	private static $allowed_actions = array(
		"accept"
	);

	public function accept()
	{
		if(!$cookie = Cookie::get('cookiesAccepted'))
		{
			$cookie = new Cookie();	
		}

		$cookie->set('cookiesAccepted', 'true', 1000);

		if(Director::is_ajax())
		{	
			echo 'success';
			return;
		}
		else 
		{
			return $this->redirect($request->getVar('redirect'));
		}
	}
}