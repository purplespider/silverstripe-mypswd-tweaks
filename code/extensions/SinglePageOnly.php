<?php
class SinglePageOnly extends DataExtension {

	function canCreate($members = null) {
		return !DataObject::get_one($this->owner->ClassName);
	}
}