<?php

class ImageFunctions extends DataExtension
{
    
    // Returns true if width of image is greater than provided value
    public function WidthGT($width = null)
    {
        if ($this->owner->getWidth() > $width) {
            return true;
        }
        return false;
    }
    
    // Returns true if height of image is greater than provided value
    public function HeightGT($height = null)
    {
        if ($this->owner->getHeight() > $height) {
            return true;
        }
        return false;
    }
    
    public function setMaxWidth($width = null)
    {
        if ($this->WidthGT($width)) {
            return $this->owner->setWidth($width);
        }
        return $this->owner;
    }
    
    public function setMaxHeight($height = null)
    {
        if ($this->HeightGT($height)) {
            return $this->owner->setHeight($height);
        }
        return $this->owner;
    }
}
