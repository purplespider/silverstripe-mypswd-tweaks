<?php
$editor = SilverStripe\Forms\HTMLEditor\HtmlEditorConfig::get('cms');
$editor->removeButtons('underline', 'alignjustify');
$editor->enablePlugins('hr');
$editor->insertButtonsAfter('indent', 'hr');

// Requires `style_formats` to be set, e.g. via site config.php. See Silverstripe Template.
$editor->insertButtonsAfter('blocks', 'styles');
$editor->removeButtons('blocks');

// Stops format styles being automatically imported from CSS, but enables ability to add custom styles using 'formats'
$editor->setOptions([
  'importcss_append' => true,
  'importcss_selector_filter' => 'abc123',
  'valid_styles' => ["*" => 'text-align'],
]);
