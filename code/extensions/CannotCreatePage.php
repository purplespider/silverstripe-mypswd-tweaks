<?php
class CannotCreatePage extends DataExtension
{

    public function canCreate($members = null)
    {
        return false;
    }
}
