<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class PageHideDependent extends Extension
{

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName("Dependent");
    }
}
