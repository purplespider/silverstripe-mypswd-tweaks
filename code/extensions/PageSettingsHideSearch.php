<?php

class PageSettingsHideSearch extends DataExtension
{

    public function updateSettingsFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Settings", "ShowInSearch");
    }
}
