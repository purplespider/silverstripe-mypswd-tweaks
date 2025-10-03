<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Security\Permission;

class CustomSiteConfig extends Extension {

	private static $db = array(
		'AnalyticsURL' => 'Varchar(255)',
		'HelpGuideURL' => 'Varchar(255)',
	);

	public function updateCMSFields(FieldList $fields) {
    	
        if (Permission::check('ADMIN')) {
            $fields->addFieldToTab("Root.Admin", TextField::create('AnalyticsURL', 'Analytics URL'));
            $fields->addFieldToTab("Root.Admin", TextField::create('HelpGuideURL', 'Help Guide URL'));
        }
        
		return $fields;
	}


}
