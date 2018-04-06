<?php
$editor = SilverStripe\Forms\HTMLEditor\HtmlEditorConfig::get('cms');
$editor->removeButtons('underline','alignjustify');
$editor->enablePlugins('hr');
$editor->insertButtonsAfter('indent','hr');
$editor->insertButtonsAfter('formatselect','styleselect');