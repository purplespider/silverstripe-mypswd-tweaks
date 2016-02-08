<?php

class StaticPublisherUpdateHomepage extends DataExtension
{
    
    public function onAfterWrite()
    {
        $urls = array();
        $urls[] = ""; // Homepage

        $sp = new FilesystemPublisher();
        $sp->publishPages($urls);

        parent::onAfterWrite();
    }
}
