<?php
class CannotCreatePage extends DataExtension {

	function canCreate($members = null) {
		return false;
	}
}