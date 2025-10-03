<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * MemberTidy Extension
 *
 * Hides often unused Member fields such as Time & Date format
 * and FailedLoginCount to clean up the Member edit form.
 */

class MemberTidy extends Extension
{


    protected function updateCMSFields(FieldList $fields)
    {
        // $fields->removeFieldFromTab("Root.Main", "TimeFormat");
        // $fields->removeFieldFromTab("Root.Main", "DateFormat");
        $fields->removeFieldFromTab("Root.Main", "HasConfiguredDashboard");
        // $fields->removeFieldFromTab("Root.Main", "Locale");
        $fields->removeFieldFromTab("Root.Main", "FailedLoginCount");
    }
}
