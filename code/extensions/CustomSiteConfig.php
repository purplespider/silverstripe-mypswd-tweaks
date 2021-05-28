<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

class CustomSiteConfig extends DataExtension {

	private static $db = array(
		'AnalyticsURL' => 'Varchar(255)',
		'HelpGuideURL' => 'Varchar(255)',
	);

	public function updateCMSFields(FieldList $fields) {
    	
        if (Permission::check('ADMIN')) {
            $fields->addFieldToTab("Root.Main", TextField::create('AnalyticsURL', 'Analytics URL'));
            $fields->addFieldToTab("Root.Main", TextField::create('HelpGuideURL', 'Help Guide URL'));
        }
        
		return $fields;
	}


}