<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Admin\CMSMenu;
use SilverStripe\ORM\DataExtension;
use SilverStripe\SiteConfig\SiteConfig;

class CMSMenuLinks extends DataExtension {

    function init() {

        $config = SiteConfig::current_site_config();

        if ($config->AnalyticsURL) {
            CMSMenu::add_link('Analytics',"Analytics",$config->AnalyticsURL,-3,array("target"=>"_blank"),'font-icon-menu-reports');
        }

        $helpGuideURL = 'https://www.silverstripe.purplespider.com/?ssv=4';
        if ($config->HelpGuideURL) {
            $helpGuideURL = $config->HelpGuideURL;
        }

        CMSMenu::add_link('Help',"Help",$helpGuideURL,-3,array("target"=>"_blank"),'font-icon-white-question');
    }
   
}