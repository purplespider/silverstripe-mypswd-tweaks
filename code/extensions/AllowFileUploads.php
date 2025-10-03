<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Security\Permission;

/**
 * AllowFileUploads Extension
 *
 * Enables file uploads (in Files tab) for all CMS users by setting
 * canCreate, canEdit, and canDelete to true for anyone with CMS access.
 */

class AllowFileUploads extends Extension
{

    protected function canCreate($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }

    protected function canEdit($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }

    // protected function canView($members = null)
    // {
    //     if (Permission::check('CMS_ACCESS_CMSMain')) {
    //         return true;
    //     }
    // }

    protected function canDelete($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }

}
