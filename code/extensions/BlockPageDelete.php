<?php
class BlockPageDelete extends DataExtension {

    // Stops Page Being Deleted
	function canDelete($members = null) {
        if(Permission::check('ADMIN')) { return true; }
        return false;
    }  

    // Stops Page Being Deleted from Live
    function canDeleteFromLive($members = null) {
        if(Permission::check('ADMIN')) { return true; }
        return false;
    }  
}