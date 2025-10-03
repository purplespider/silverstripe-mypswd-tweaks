<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;

/**
 * CannotCreatePage Extension
 *
 * Apply this extension to page types that you don't want non-admin users
 * to be able to create. Set sstweaks_can_create: true in config to allow creation.
 */
class CannotCreatePage extends Extension
{

    protected function canCreate($member = null, $context = array())
    {
        if ($config = $this->owner->config()->get('sstweaks_can_create')) {
            return true;
        }

        return false;
    }

}
