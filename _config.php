<?php

namespace StudioBonito\CookieBar;

use SilverStripe\ORM\DataObject;
use PageController;
use SilverStripe\SiteConfig\SiteConfig;
use StudioBonito\CookieBar\CookieSiteConfig;
use StudioBonito\CookieBar\CookiePageExtension;
use StudioBonito\CookieBar\CookieBarController;
use SilverStripe\Control\Director;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Core\Extensible;
use SilverStripe\Core\Injector\Injectable;
use SilverStripe\Core\Config\Configurable;

//Decorators
DataObject::add_extension(SiteConfig::class, CookieSiteConfig::class);
DataObject::add_extension(PageController::class, CookiePageExtension::class);

define('MOD_CB_PATH',rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR));
$folders = explode(DIRECTORY_SEPARATOR,MOD_CB_PATH);
define('MOD_CB_DIR',rtrim(array_pop($folders),DIRECTORY_SEPARATOR));
unset($folders);