<?php
use SilverStripe\TinyMCE\TinyMCEConfig;

$editor = TinyMCEConfig::get('cms');
$editor->removeButtons('underline','alignjustify');
$editor->enablePlugins('hr');
$editor->insertButtonsAfter('indent','hr');
$editor->insertButtonsAfter('blocks','styles');
$editor->removeButtons('blocks');

// Stops format styles being automatically imported from CSS, but enables ability to add custom styles using 'formats'
$editor->setOptions([
  'importcss_append' => true,
  'importcss_selector_filter' => 'abc123',
  'valid_styles' => ["*" => 'text-align'],
]);

// Disable table appearance options (Cell spacing, Cell padding, Border, Caption)
$editor->setOption('table_appearance_options', false);

// Disable Advanced tab in Cell Properties dialog (border colors, background colors)
$editor->setOption('table_cell_advtab', false);

// Disable Advanced tab in Row Properties dialog (border colors, background colors)
$editor->setOption('table_row_advtab', false);
