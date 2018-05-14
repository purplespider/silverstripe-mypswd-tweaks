<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class PageHideExtraMeta extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {
      $fields->removeFieldFromTab("Root.Main", "MetaKeywords");
      $fields->removeFieldFromTab("Root.Main", "ExtraMeta");
    }
}
