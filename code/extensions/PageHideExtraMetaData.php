<?php

class PageHideExtraMetaData extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeFieldFromTab("Root.Main", "MetaKeywords");
        $fields->removeFieldFromTab("Root.Main", "ExtraMeta");
        $fields->removeByName("Dependent");
    }
}
