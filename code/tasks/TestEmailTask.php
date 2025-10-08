<?php

namespace PurpleSpider\MySite;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\SiteConfig\SiteConfig;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class TestEmailTask extends BuildTask
{

    protected $title = 'Send Test Email';

    protected $description = "Instantly sends a test email. Add ?fail to check failure message.";

    public function run($request)
    {

        $domain = Director::absoluteBaseURL();
        $to = 'silverstripe-test-email-task@pswd.biz';
        $config = SiteConfig::current_site_config();

        echo ("Sending email...<br>");

        $email = Email::create()
            ->setBody("Test email from {$config->Title} - {$domain}. ")
            ->setTo($to)
            ->setSubject("Test: {$config->Title} - {$domain}");

        if (isset($_GET['fail'])) {
            $email->getSwiftMessage()->getHeaders()->addTextHeader('X-PM-Message-Stream', 'non-existant-broadcast-stream');
        }

        try {
            $email->send();
        } catch (TransportExceptionInterface $e) {
            echo ("Error sending: " . $e);
        }

        echo ("Done");
    }
}
