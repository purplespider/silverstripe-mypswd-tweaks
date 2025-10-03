<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * PageSettingsHidePermissions Extension
 *
 * Hides Page permission fields (CanViewType, ViewerGroups, CanEditType,
 * EditorGroups) from the Settings tab. Set sstweaks_show_permissions: true
 * in config to show permissions for specific page types.
 */

class PageSettingsHidePermissions extends Extension
{

    protected function updateSettingsFields(FieldList $fields)
    {
        if (!$this->owner->config()->get('sstweaks_show_permissions')) {
            $fields->removeFieldFromTab("Root.Settings", "CanViewType");
            $fields->removeFieldFromTab("Root.Settings", "ViewerGroups");
            $fields->removeFieldFromTab("Root.Settings", "CanEditType");
            $fields->removeFieldFromTab("Root.Settings", "EditorGroups");
        }
    }
}
