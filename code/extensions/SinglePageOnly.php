<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\ORM\DataObject;

/**
 * SinglePageOnly Extension
 *
 * Can be applied to any page type to ensure only one instance can be created.
 * Useful for keeping the "Add New" page type list tidy.
 */

class SinglePageOnly extends Extension
{

    protected function canCreate($members = null)
    {
        return !DataObject::get_one($this->owner->ClassName);
    }
}
