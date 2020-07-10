<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;

class CannotCreatePage extends DataExtension
{
  
    public function canCreate($member = null, $context = array())
    {
        if ($config = $this->owner->config()->get('can_create')) {
            return true;
        }
        
        return false;
    }

}
