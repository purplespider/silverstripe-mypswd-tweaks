<?php

namespace PurpleSpider\MySite;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use SilverStripe\Control\Director;
use SilverStripe\Control\Email\Email;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * TestEmail Task
 *
 * Instantly sends a test email to verify email deliverability and configuration.
 * Useful for quickly checking that email is working correctly on the server.
 *
 * Usage:
 *   sake tasks:TestEmail          - Send test email normally
 *   sake tasks:TestEmail --fail   - Simulate email failure for testing error handling
 */
class TestEmailTask extends BuildTask {

    protected string $title = 'Send Test Email';

    protected static string $description = "Instantly sends a test email. Use --fail option to check failure message.";

    protected static string $commandName = 'TestEmail';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        $domain = Director::absoluteBaseURL();
        $to = 'silverstripe-test-email-task@pswd.biz';
        $config = SiteConfig::current_site_config();

        $output->writeln("Sending email...");

        try {
            $email = Email::create()
                ->setBody("Test email from {$config->Title} - {$domain}. ")
                ->setTo($to)
                ->setSubject("Test: {$config->Title} - {$domain}");

            if ($input->getOption('fail')) {
                // Simulate failure by using invalid email address
                $email->setTo('invalid-email-address');
            }

            $email->send();
            $output->writeln("Sent!");
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $output->writeln("Failed. Email not sent.");
            $output->writeln("Error: " . $e->getMessage());
            return Command::FAILURE;
        }
    }

    public function getOptions(): array
    {
        return [
            new InputOption('fail', null, InputOption::VALUE_NONE, 'Simulate email failure'),
        ];
    }

}