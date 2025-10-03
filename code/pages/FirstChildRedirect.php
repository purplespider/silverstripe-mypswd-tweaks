<?php

namespace PurpleSpider\SSTweaks;

use Page;
use PageController;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Control\HTTPResponse;

/**
 * FirstChildRedirect
 *
 * Automatically redirects to the first child of this page.
 * Useful for top level pages with no content of their own.
 */
class FirstChildRedirect extends Page
{
    private static string $table_name = 'FirstChildRedirect';

    private static string $description = "Automatically redirects to the first child of this page";

    private static string $icon_class = 'font-icon-p-redirect';

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

class FirstChildRedirectController extends PageController
{
    public function index()
    {
        // Redirect to first child if it exists
        if ($this->data()->Children()->Count()) {
            return $this->redirect($this->data()->Children()->First()->Link());
        }

        // No children, return normal page response
        return parent::index();
    }
}
