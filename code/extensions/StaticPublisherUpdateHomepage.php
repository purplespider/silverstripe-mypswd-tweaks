<?php
  
class StaticPublisherUpdateHomepage extends DataExtension {
    
   function onAfterWrite() {

   		$urls = array();
   		$urls[] = ""; // Homepage

	    $sp = new FilesystemPublisher();
	    $sp->publishPages($urls);

	    parent::onAfterWrite();
	}

}