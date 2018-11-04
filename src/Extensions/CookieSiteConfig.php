<?php
	
namespace StudioBonito\CookieBar;

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;
	
/****************
 * 
 * Add cookie config options to site config
 *
 * Studio Bonito
 * http://studiobonito.co.uk
 *
 * Extended from the work by:
 * Aab Web
 * www.aabweb.co.uk
 * 
 * author: Steve Heyes, Craig Ballantyne
 * date: 23.10.2012
 * version: 1.1.0
 *
 * Update for Silverstripe 4 4.11.2018
 * Codesipro
 */
class CookieSiteConfig extends DataExtension 
{
	private static $db = array(
		'CookieBarTitle' => 'Varchar(255)',
		'CookieBarContent' => 'HTMLText',
		'CookieCloseText' => 'Varchar(100)',
		'CookieMoreText' => 'Varchar(150)',
		'CookieBarEnable' => 'Boolean'
	);

	private static $has_one = array(
		'CookiePage' => SiteTree::class,
		'CookieImage' => Image::class,
	);

	public static $defaults = array(
		'CookieCloseText' => 'Accept',
		'CookieMoreText' => 'Read more about Cookies',
		'CookieBarContent' => '<p><strong>Like most websites we uses cookies</strong>. In order to deliver a personalised, responsive service and to improve the site, we remember and store information about how you use it. This is done using simple text files called cookies which sit on your computer. These cookies are completely safe and secure and will never contain any sensitive information. They are used only by us.</p>',
	);
	
	public function updateCMSFields(FieldList $fields)
	{
		$fields->addFieldToTab('Root.CookieBar', CheckboxField::create('CookieBarEnable', 'Enable Cookie Bar'));

		$fields->addFieldToTab('Root.CookieBar', TreeDropdownField::create('CookiePageID', 'Cookie Information Page', 'SiteTree'));
		$fields->addFieldToTab('Root.CookieBar', TextField::create('CookieCloseText', 'Accept/Close Link Text'));
		$fields->addFieldToTab('Root.CookieBar', TextField::create('CookieMoreText', 'More Information Link Text'));

		$imageField = UploadField::create('CookieImage', 'Image (optional)');
        $imageField->getValidator()->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
		$fields->addFieldToTab('Root.CookieBar', $imageField);
		$fields->addFieldToTab('Root.CookieBar', TextField::create('CookieBarTitle', 'Cookie Bar Title'));
		$fields->addFieldToTab('Root.CookieBar', HTMLEditorField::create('CookieBarContent', 'Cookie bar Content (hidden on mobile)'));
   	}
}