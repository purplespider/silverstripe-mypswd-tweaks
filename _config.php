<?php

// TinyMCE Tweaks
HtmlEditorConfig::get('cms')->setOption('paste_text_sticky', 'true');
HtmlEditorConfig::get('cms')->setOption('paste_text_sticky_default', 'true');
HtmlEditorConfig::get('cms')->setOption('theme_advanced_disable', 'underline,justifyfull,pasteword,spellchecker');

// Create Simple HTMLEditor Config for use with nathancox/customhtmleditorfield
if (class_exists('CustomHtmlEditorConfig')) {
	$simpleConfig = CustomHtmlEditorConfig::copy('simple', 'cms');
	$simpleConfig->setOption('friendly_name', 'Simple WYSIWYG');
	$simpleConfig->setOption('width', '60%');
	$simpleConfig->setOption('theme_advanced_statusbar_location', 'none');
	$simpleConfig->setButtonsForLine(1, array("bold","italic",'formatselect','bulist','numlist','outdent','indent','pastetext','ssmedia','sslink','unlink','code'));
	$simpleConfig->setButtonsForLine(2, array());
	$simpleConfig->setButtonsForLine(3, array());
	$simpleConfig->setOption('theme_advanced_disable', "sub,sup");
	$simpleConfig->setOption('theme_advanced_blockformats', 'p,Heading=h3');
}

// Set JPG Quality
GD::set_default_quality(90);

// Custom CSS for CMS
LeftAndMain::require_css('custom-pswd/css/cms.css');

// Remove any extensions via the mysite/_config.php, eg.:
// Page::remove_extension('PageHideExtraMetaData');
// Page::remove_extension('PageSettingsHideSearch');
// Page::remove_extension('PageSettingsHidePermissions');
// Member::remove_extension('MemberTidy');
// UserDefinedForm::remove_extension('HideUserDefinedForm');