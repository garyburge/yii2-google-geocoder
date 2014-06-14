<?php

namespace filsh\yii2\googleGeocoder\resources;

class Bounds extends Resource implements ResourceInterface
{
    public function getSouthwest()
    {
        if (isset($this->data['southwest']) && is_array($this->data['southwest'])) {
            return new LatLng($this->data['southwest']);
        }
        return null;
    }
    
    public function getNortheast()
    {
        if (isset($this->data['northeast']) && is_array($this->data['northeast'])) {
            return new LatLng($this->data['northeast']);
        }
        return null;
    }
}