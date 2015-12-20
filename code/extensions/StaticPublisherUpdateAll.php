<?php

class StaticPublisherUpdateAll extends DataExtension
{
    
    public function onAfterWrite()
    {
        $sp = new FilesystemPublisher();
        $sp->publishPages(Page::get()->first()->allPagesToCache());

        parent::onAfterWrite();
    }
}
