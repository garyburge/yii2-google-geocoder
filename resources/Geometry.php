<?php

namespace filsh\yii2\googleGeocoder\resources;

class Geometry extends Resource implements ResourceInterface
{
    const APPROXIMATE = 'approximate';
    const GEOMETRIC_CENTER = 'geometric_center';
    const RANGE_INTERPOLATED = 'range_interpolated';
    const ROOFTOP = 'rooftop';
    
    public function getBounds()
    {
        if (isset($this->data['bounds']) && is_array($this->data['bounds'])) {
            return new Bounds($this->data['bounds']);
        }
        return null;
    }
    
    public function getLocation()
    {
        if (isset($this->data['location']) && is_array($this->data['location'])) {
            return new LatLng($this->data['location']);
        }
        return null;
    }
    
    public function getLocationType()
    {
        if (isset($this->data['location_type']) && is_string($this->data['location_type'])) {
            return $this->data['location_type'];
        }
        return null;
    }
    
    public function getViewport()
    {
        if (isset($this->data['viewport']) && is_array($this->data['viewport'])) {
            return new Viewport($this->data['viewport']);
        }
        return null;
    }
}