<?php

namespace PurpleSpider\MySite;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\SiteConfig\SiteConfig;

class TestEmailTask extends BuildTask {

    protected $title = 'Send Test Email';

    protected $description = "Instantly sends a test email. Add ?fail to check failure message.";

    public function run($request) {

        $domain = Director::absoluteBaseURL();
        $to = 'silverstripe-test-email-task@pswd.biz';
        $config = SiteConfig::current_site_config();
        
        echo("Sending email...<br>");

        $email = Email::create()
        ->setBody("Test email from {$config->Title} - {$domain}. ")
        ->setTo($to)
        ->setSubject("Test: {$config->Title} - {$domain}");

        if(isset($_GET['fail'])) {
            // Note: Custom headers for testing email failures may need to be adjusted
            // depending on your email provider's requirements in Silverstripe 6
            $email->getHeaders()->addTextHeader('X-PM-Message-Stream', 'non-existant-broadcast-stream');
        }

        if($email->send()) {
            echo("Sent!");
        } else {
            echo("Failed. Email not sent.");
        }

    }

}