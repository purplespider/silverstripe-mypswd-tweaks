<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Core\Extension;
use SilverStripe\Admin\CMSMenu;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * CMSMenuLinks Extension
 *
 * Adds customizable CMS menu links for Analytics and Help Guide.
 * Links are configured via CustomSiteConfig extension in SiteConfig.
 */

class CMSMenuLinks extends Extension {

    protected function onInit() {

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