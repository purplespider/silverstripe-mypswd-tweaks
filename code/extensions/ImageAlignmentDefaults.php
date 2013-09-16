<?php

class ImageAlignmentDefaults extends Extension {
	
	private static $insert_width = 200; 
	
    public function updateFieldsForImage(&$fields, $url, $file) {
        $fields->removeByName('CaptionText'); 
        $dropdown = DropdownField::create(
				'CSSClass',
				_t('HtmlEditorField.CSSCLASS', 'Alignment / style'),
				array(
					'left' => _t('HtmlEditorField.CSSCLASSLEFT', 'On the left, with text wrapping around.'),
					'right' => _t('HtmlEditorField.CSSCLASSRIGHT', 'On the right, with text wrapping around.'),
					'leftAlone' => _t('HtmlEditorField.CSSCLASSLEFTALONE', 'On the left, on its own.'),
					'center' => _t('HtmlEditorField.CSSCLASSCENTER', 'Centered, on its own.')
				)
			);
			
        $fields->insertBefore($dropdown, 'AltText');       
    }
}