<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataObject;

class SinglePageOnly extends Extension
{

    public function canCreate($members = null)
    {
        return !DataObject::get_one($this->owner->ClassName);
    }
}
