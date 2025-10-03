<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\URLField;
use SilverStripe\Security\Permission;

/**
 * CustomSiteConfig Extension
 *
 * Adds admin-configurable URL fields to SiteConfig for Analytics and Help Guide.
 * These URLs are used by the CMSMenuLinks extension to add CMS menu items.
 */

class CustomSiteConfig extends Extension {

	private static $db = array(
		'AnalyticsURL' => 'URL',
		'HelpGuideURL' => 'URL',
	);

	protected function updateCMSFields(FieldList $fields) {

        if (Permission::check('ADMIN')) {
            $fields->addFieldToTab("Root.Admin", URLField::create('AnalyticsURL', 'Analytics URL'));
            $fields->addFieldToTab("Root.Admin", URLField::create('HelpGuideURL', 'Help Guide URL'));
        }

		return $fields;
	}


}
