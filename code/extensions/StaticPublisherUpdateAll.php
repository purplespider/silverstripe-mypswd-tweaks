<?php
  
class StaticPublisherUpdateAll extends DataExtension {
    
   function onAfterWrite() {

	    $sp = new FilesystemPublisher();
	    $sp->publishPages(Page::get()->first()->allPagesToCache());

	    parent::onAfterWrite();
	}

}