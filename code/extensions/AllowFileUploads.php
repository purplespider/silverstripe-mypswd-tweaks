<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Security\Permission;

class AllowFileUploads extends Extension
{
  
    public function canCreate($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }

    public function canEdit($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }
    
    // public function canView($members = null)
    // {
    //     if (Permission::check('CMS_ACCESS_CMSMain')) {
    //         return true;
    //     }
    // }
    
    public function canDelete($members = null)
    {
        if (Permission::check('CMS_ACCESS_CMSMain')) {
            return true;
        }
    }

}
