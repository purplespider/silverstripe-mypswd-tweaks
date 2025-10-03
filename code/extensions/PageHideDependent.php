<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

/**
 * PageHideDependent Extension
 *
 * Hides the "Dependent" tab from the Page CMS interface.
 */

class PageHideDependent extends Extension
{

    protected function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName("Dependent");
    }
}
