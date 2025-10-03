<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\PolyExecution\PolyOutput;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use SilverStripe\Control\Director;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;

/**
 * GenerateCMSThumbs Task
 *
 * Runs generateThumbnails() on each File object in the system.
 * Useful after running MigrateFileTask when using legacy_filenames,
 * to ensure all CMS thumbnails are properly generated for the asset admin.
 *
 * Usage: sake tasks:GenerateCMSThumbs
 */
class GenerateCMSThumbs extends BuildTask
{
    protected string $title = 'Generate CMS Thumbnails';
    protected static string $commandName = 'GenerateCMSThumbs';

    protected function execute(InputInterface $input, PolyOutput $output): int
    {
        set_time_limit(0);

        $admin = self::singleton(AssetAdmin::class);
        $files = File::get();
        $total = $files->count();
        $count = 0;
        foreach ($files as $file) {
          $count++;
          $name = $file->getFilename();
          $originalDir = BASE_PATH . '/'.Director::publicDir().'/assets/';
          $admin->generateThumbnails($file);
          $output->writeln("Generated {$count}/{$total}: ".$name);
        }

        $output->writeln("\r\nComplete!\r\n");
        return Command::SUCCESS;
    }
}
