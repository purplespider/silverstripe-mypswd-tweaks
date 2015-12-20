<?php
class BlockPageDelete extends DataExtension
{

    // Stops Page Being Deleted
    public function canDelete($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }

    // Stops Page Being Deleted from Live
    public function canDeleteFromLive($members = null)
    {
        if (Permission::check('ADMIN')) {
            return true;
        }
        return false;
    }
}
