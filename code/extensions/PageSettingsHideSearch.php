<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class PageSettingsHideSearch extends Extension
{

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Settings", "ShowInSearch");
    }
}
