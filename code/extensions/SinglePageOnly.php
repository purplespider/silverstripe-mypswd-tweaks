<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DataExtension;

class SinglePageOnly extends DataExtension
{

    public function canCreate($members = null): ?bool
    {
        return !DataObject::get_one($this->owner->ClassName);
    }
}
