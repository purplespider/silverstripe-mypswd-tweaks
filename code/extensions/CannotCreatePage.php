<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
class CannotCreatePage extends Extension
{
  
    public function canCreate($member = null, $context = array())
    {
        if ($config = $this->owner->config()->get('sstweaks_can_create')) {
            return true;
        }
        
        return false;
    }

}
