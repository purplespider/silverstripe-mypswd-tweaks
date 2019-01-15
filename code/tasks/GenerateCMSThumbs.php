<?php

namespace PurpleSpider\SSTweaks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Control\Director;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Controller\AssetAdmin;
use SilverStripe\ORM\DB;

class GenerateCMSThumbs extends BuildTask
{
    protected $title = 'Generate CMS Thumbnails';
    private static $segment = 'GenerateCMSThumbs';
  
    public function run($request)
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
          if(Director::is_cli()) {
            echo "Generated {$count}/{$total}: ".$name."\r\n";
          } else {
            echo '<b style="color:green">Generated: '.$name.'</b><br>';
          }
        }

        echo "\r\nComplete!\r\n\r\n";
    }
}
