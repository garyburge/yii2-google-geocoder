<?php

namespace filsh\yii2\googleGeocoder;

class Geocoder extends \yii\base\Component
{
    public $clientId;
    
    private $_service;
    
    public function init()
    {
        parent::init();
        $this->_service = (new \GoogleMapsGeocoder())->setClientId($this->clientId);
    }
    
    public function geocode($https = false)
    {
        $response = $this->_service->geocode($https, true);
        return new Response($response, $this->getFormat());
    }
    
    public function __call($name, $params)
    {
        if(method_exists($this->_service, $name)) {
            return call_user_func_array([$this->_service, $name], $params);
        } else {
            return parent::__call($name, $params);
        }
    }
}