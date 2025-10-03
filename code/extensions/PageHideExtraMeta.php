<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class PageHideExtraMeta extends Extension
{

    public function updateCMSFields(FieldList $fields)
    {
      $fields->removeFieldFromTab("Root.Main", "MetaKeywords");
      $fields->removeFieldFromTab("Root.Main", "ExtraMeta");
    }
}
