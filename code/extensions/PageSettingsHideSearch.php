<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class PageSettingsHideSearch extends DataExtension
{

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Settings", "ShowInSearch");
    }
}
