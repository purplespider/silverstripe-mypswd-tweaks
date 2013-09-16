<?php

// TinyMCE Tweaks
HtmlEditorConfig::get('cms')->setOption('paste_text_sticky', 'true');
HtmlEditorConfig::get('cms')->setOption('paste_text_sticky_default', 'true');
HtmlEditorConfig::get('cms')->setOption('theme_advanced_disable', 'underline,justifyfull,pasteword,spellchecker');

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