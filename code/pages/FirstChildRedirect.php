<?php

class FirstChildRedirect extends Page {

	private static $description = "Automatically redirects to the first child of this page";

	private static $icon = "mypswd-tweaks/images/icons/first-child-redirect";

	public function getCMSFields() {
    	$fields = parent::getCMSFields();
 		
 		$fields->addFieldToTab("Root.Main", new LiteralField("Desc","<h2>First Child Redirect Page</h2><p>This page automatically redirects to it's first child page.</p>"));
		$fields->removeFieldFromTab("Root.Main","Content");
 		
		return $fields;
   }
		
}

class FirstChildRedirect_Controller extends Page_Controller {
 	
 	function  init() {
	    parent::init();
	 
	    if($this->Children()->Count()){
	        Controller::redirect($this->Children()->First()->AbsoluteLink());
	    }
	}
 
}

?>
