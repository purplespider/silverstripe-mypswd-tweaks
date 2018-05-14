<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class PageSettingsHidePermissions extends DataExtension
{

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Settings", "CanViewType");
        $fields->removeFieldFromTab("Root.Settings", "ViewerGroups");
        $fields->removeFieldFromTab("Root.Settings", "CanEditType");
        $fields->removeFieldFromTab("Root.Settings", "EditorGroups");
    }
}
