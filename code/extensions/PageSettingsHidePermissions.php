<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class PageSettingsHidePermissions extends Extension
{

    public function updateSettingsFields(FieldList $fields)
    {
        if (!$this->owner->config()->get('sstweaks_show_permissions')) {
            $fields->removeFieldFromTab("Root.Settings", "CanViewType");
            $fields->removeFieldFromTab("Root.Settings", "ViewerGroups");
            $fields->removeFieldFromTab("Root.Settings", "CanEditType");
            $fields->removeFieldFromTab("Root.Settings", "EditorGroups");
        }
    }
}
