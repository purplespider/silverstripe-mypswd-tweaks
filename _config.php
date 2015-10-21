<?php

// TinyMCE Tweaks
HtmlEditorConfig::get('cms')->setOption('theme_advanced_disable', 'underline,justifyfull,pasteword,spellchecker');
HtmlEditorConfig::get('cms')->setOption('valid_styles', array('*' => 'text-align'));
HtmlEditorConfig::get('cms')// Add support for HTML5 elements in tinymce editor
    ->setOption('extended_valid_elements',
        '+article,aside,audio[src|preload<none?metadata?auto|autoplay<autoplay|loop<loop|controls<controls|mediagroup],canvas[width,height],'
        .'datalist[data],details[open<open],eventsource[src],fieldset[disabled<disabled|form|name],header,mark,menu[type<context?toolbar?list|label],'
        .'meter[value|min|low|high|max|optimum],nav,progress[value,max],script[src|async<async|defer<defer|type|charset],section,time[datetime],'
        .'video[preload<none?metadata?auto|src|crossorigin|poster|autoplay<autoplay|mediagroup|loop<loop|muted<muted|controls<controls|width|height],wbr,#span,'
        .'form[id|method|onsubmit|onreset|action],input[id|name|style|type|placeholder],label[for]'
    )
    ->setOptions(array(//clean up the actions upon pasting text in
        'paste_remove_spans'            => true,
        'paste_remove_styles'           => true,
        'paste_remove_styles_if_webkit' => true,
        'force_br_newlines'             => true,
        'force_p_newlines'              => false,
        'paste_text_linebreaktype'      => "br",
        'paste_auto_cleanup_on_paste'   => true,
    ));

// Create Simple HTMLEditor Config for use with nathancox/customhtmleditorfield
if (class_exists('CustomHtmlEditorConfig')) {
	$simpleConfig = CustomHtmlEditorConfig::copy('simple', 'cms');
	$simpleConfig->setOption('friendly_name', 'Simple WYSIWYG');
	$simpleConfig->setOption('width', '60%');
	$simpleConfig->setOption('theme_advanced_statusbar_location', 'none');
	$simpleConfig->setButtonsForLine(1, array("bold","italic",'formatselect','bullist','numlist','outdent','indent','pastetext','ssmedia','sslink','unlink','code'));
	$simpleConfig->setButtonsForLine(2, array());
	$simpleConfig->setButtonsForLine(3, array());
	$simpleConfig->setOption('theme_advanced_disable', "sub,sup");
	$simpleConfig->setOption('theme_advanced_blockformats', 'p,Heading=h3');
}

// Changes Image backend to GD (required for SilverStripe Optimised Image module)
if (class_exists('OptimisedGDBackend')) { 
	Image::set_backend("OptimisedGDBackend");
}

// Remove any extensions via the mysite/_config.php, eg.:
// Page::remove_extension('PageHideExtraMetaData');
// Page::remove_extension('PageSettingsHideSearch');
// Page::remove_extension('PageSettingsHidePermissions');
// Member::remove_extension('MemberTidy');
// UserDefinedForm::remove_extension('HideUserDefinedForm');