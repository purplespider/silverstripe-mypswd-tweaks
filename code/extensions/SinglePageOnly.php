<?php
class SinglePageOnly extends DataExtension
{

    public function canCreate($members = null)
    {
        return !DataObject::get_one($this->owner->ClassName);
    }
}
