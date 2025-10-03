<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * PageHideExtraMeta Extension
 *
 * Hides MetaKeywords and ExtraMeta fields from the Page CMS interface.
 */

class PageHideExtraMeta extends Extension
{

    protected function updateCMSFields(FieldList $fields)
    {
      $fields->removeFieldFromTab("Root.Main", "MetaKeywords");
      $fields->removeFieldFromTab("Root.Main", "ExtraMeta");
    }
}
