<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Security\Permission;

/**
 * BlockPageArchive Extension
 *
 * Disables ability to Archive or Unpublish a page for non-admin users.
 * Useful for protecting important pages like HomePage.
 */

class BlockPageArchive extends Extension
{

    // Stops Page Being Deleted
    protected function canDelete($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }

    // Stops Page Being Deleted from Live
    protected function canUnpublish($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }
}
