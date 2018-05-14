<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

class BlockPageArchive extends DataExtension
{

    // Stops Page Being Deleted
    public function canDelete($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }

    // Stops Page Being Deleted from Live
    public function canUnpublish($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }
}
