<?php

class CMSHelpLink extends DataExtension {
	
	function init() {
		CMSMenu::remove_menu_item('Help');
		CMSMenu::add_link('Help',"Help","http://www.silverstripe.purplespider.com/".Config::inst()->get($this->class, 'url'),-2,array("target"=>"_blank"));
	}
	
}