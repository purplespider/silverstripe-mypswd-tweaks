<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\DB;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\Security;
use SilverStripe\Forms\ReadonlyField;

/**
 * MemberLog Extension
 *
 * Tracks member login activity by recording LastVisited datetime and
 * NumVisit count. Displays this information in the Member edit form.
 */

class MemberLog extends Extension
{
    private static $db = [
        'LastVisited' => 'Datetime',
        'NumVisit' => 'Int',
    ];

    protected function onAfterMemberLoggedIn()
    {
        $this->logVisit();
    }

    protected function memberAutoLoggedIn()
    {
        $this->logVisit();
    }

    protected function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab('Root.Main', [
            ReadonlyField::create('LastVisited', 'Last visited'),
            ReadonlyField::create('NumVisit', 'Number of visits')
        ]);
    }

    protected function logVisit()
    {
        if (!Security::database_is_ready()) return;

        DB::query(sprintf(
            'UPDATE "Member" SET "LastVisited" = %s, "NumVisit" = "NumVisit" + 1 WHERE "ID" = %d',
            DB::get_conn()->now(),
            $this->owner->ID
        ));
    }
}