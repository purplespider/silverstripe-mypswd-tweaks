<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DB;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Security;
use SilverStripe\Forms\ReadonlyField;

class MemberLog extends DataExtension
{
    private static $db = [
        'LastVisited' => 'Datetime',
        'NumVisit' => 'Int',
    ];

    public function afterMemberLoggedIn()
    {
        $this->logVisit();
    }

    public function memberAutoLoggedIn()
    {
        $this->logVisit();
    }

    public function updateCMSFields(FieldList $fields)
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