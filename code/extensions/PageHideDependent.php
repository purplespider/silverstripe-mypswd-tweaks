<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;

class PageHideDependent extends DataExtension
{

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName("Dependent");
    }
}
