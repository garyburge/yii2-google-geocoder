<?php

namespace filsh\yii2\googleGeocoder\resources;

class LatLng extends Resource implements ResourceInterface
{
    public function getLat()
    {
        if (isset($this->data['lat']) && is_numeric($this->data['lat'])) {
            return $this->data['lat'];
        }
        return null;
    }
    
    public function getLng()
    {
        if (isset($this->data['lng']) && is_numeric($this->data['lng'])) {
            return $this->data['lng'];
        }
        return null;
    }
}