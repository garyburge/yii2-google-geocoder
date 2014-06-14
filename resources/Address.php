<?php

namespace filsh\yii2\googleGeocoder\resources;

class Address extends Resource implements ResourceInterface
{
    const STREET_ADDRESS = 'street_address';
    const ROUTE = 'route';
    const INTERSECTION = 'intersection';
    const POLITICAL = 'political';
    const COUNTRY = 'country';
    const ADMINISTRATIVE_AREA_LEVEL1 = 'administrative_area_level_1';
    const ADMINISTRATIVE_AREA_LEVEL2 = 'administrative_area_level_2';
    const ADMINISTRATIVE_AREA_LEVEL3 = 'administrative_area_level_3';
    const COLLOQUIAL_AREA = 'colloquial_area';
    const LOCALITY = 'locality';
    const SUBLOCALITY = 'sublocality';
    const NEIGHBORHOOD = 'neighborhood';
    const PREMISE = 'premise';
    const SUBPREMISE = 'subpremise';
    const POSTAL_CODE = 'postal_code';
    const NATURAL_FEATURE = 'natural_feature';
    const AIRPORT = 'airport';
    const PARK = 'park';
    const POINT_OF_INTEREST = 'point_of_interest';
    const POST_BOX = 'post_box';
    const STREET_NUMBER = 'street_number';
    const FLOOR = 'floor';
    const ROOM = 'room';
    
    public function getLongName()
    {
        if (isset($this->data['long_name']) && is_string($this->data['long_name'])) {
            return $this->data['long_name'];
        }
    }
    
    public function getShortName()
    {
        if (isset($this->data['short_name']) && is_string($this->data['short_name'])) {
            return $this->data['short_name'];
        }
        return null;
    }
    
    public function getTypes()
    {
        if (isset($this->data['types']) && is_array($this->data['types'])) {
            return $this->data['types'];
        }
        return [];
    }
}