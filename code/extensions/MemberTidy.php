<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class MemberTidy extends Extension
{
    
    
    public function updateCMSFields(FieldList $fields)
    {
        // $fields->removeFieldFromTab("Root.Main", "TimeFormat");
        // $fields->removeFieldFromTab("Root.Main", "DateFormat");
        $fields->removeFieldFromTab("Root.Main", "HasConfiguredDashboard");
        // $fields->removeFieldFromTab("Root.Main", "Locale");
        $fields->removeFieldFromTab("Root.Main", "FailedLoginCount");
    }
}
