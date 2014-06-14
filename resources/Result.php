<?php

namespace filsh\yii2\googleGeocoder\resources;

use filsh\yii2\googleGeocoder\service\DataIterator;

class Result extends Resource implements ResourceInterface
{
    /**
     * @return \filsh\yii2\googleGeocoder\service\DataIterator
     */
    public function getAddressComponents()
    {
        if (isset($this->data['address_components']) && is_array($this->data['address_components'])) {
            return new DataIterator('\filsh\yii2\googleGeocoder\resources\Address', $this->data['address_components']);
        }
        return [];
    }
    
    public function getTypes()
    {
        if (isset($this->data['types']) && is_array($this->data['types'])) {
            return $this->data['types'];
        }
        return [];
    }
    
    public function getFormattedAddress()
    {
        if (isset($this->data['formatted_address']) && is_string($this->data['formatted_address'])) {
            return $this->data['formatted_address'];
        }
        return null;
    }
    
    public function getGeometry()
    {
        if (isset($this->data['geometry']) && is_array($this->data['geometry'])) {
            return new Geometry($this->data['geometry']);
        }
        return null;
    }
    
    public function getPartialMatch()
    {
        if (isset($this->data['partial_match']) && is_string($this->data['partial_match'])) {
            return $this->data['partial_match'];
        }
        return null;
    }
}