<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * PageSettingsHideSearch Extension
 *
 * Hides the ShowInSearch field from the Page Settings tab.
 */

class PageSettingsHideSearch extends Extension
{

    protected function updateSettingsFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Settings", "ShowInSearch");
    }
}
