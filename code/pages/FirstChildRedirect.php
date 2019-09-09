<?php

namespace PurpleSpider\SSTweaks;

use Page;
use PageController;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\Controller;

class FirstChildRedirect extends Page
{

    private static $description = "Automatically redirects to the first child of this page";

    private static $icon_class = 'font-icon-p-redirect';

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        
        $fields->addFieldToTab("Root.Main", new LiteralField("Desc", "<h2>First Child Redirect Page</h2><p>This page has no content, it has the type <strong>First Child Redirect Page</strong> and so automatically redirects to it's first child page.</p><p>
        To change this, edit the <strong>Page type</strong> via <strong>Settings</strong>, in the top right.
        </p>"),'Metadata');
        $fields->removeFieldFromTab("Root.Main", "Content");
        
        return $fields;
    }
}

class FirstChildRedirect_Controller extends PageController
{
    
    public function init()
    {
        parent::init();
     
        if ($this->Children()->Count()) {
            Controller::redirect($this->Children()->First()->AbsoluteLink());
        }
    }
}
