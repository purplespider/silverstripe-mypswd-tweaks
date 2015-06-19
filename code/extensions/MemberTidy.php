<?php

class MemberTidy extends DataExtension {
	
	
	public function updateCMSFields(FieldList $fields) {
	   $fields->removeFieldFromTab("Root.Main","TimeFormat");
	   $fields->removeFieldFromTab("Root.Main","DateFormat");
	   $fields->removeFieldFromTab("Root.Main","HasConfiguredDashboard");
	   $fields->removeFieldFromTab("Root.Main","Locale");
       $fields->removeFieldFromTab("Root.Main","FailedLoginCount");
	}
	
}