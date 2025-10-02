<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Security\Permission;

class AllowFileUploads extends DataExtension
{
  
    public function canCreate($members = null): ?bool
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
        return null;
    }

    public function canEdit($members = null): ?bool
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
        return null;
    }
    
    // public function canView($members = null): ?bool
    // {
    //     if (Permission::check('CMS_ACCESS_CMSMain')) {
    //         return true;
    //     }
    //     return null;
    // }
    
    public function canDelete($members = null): ?bool
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
        return null;
    }

}
