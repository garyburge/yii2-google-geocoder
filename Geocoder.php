<?php

namespace filsh\yii2\googleGeocoder;

use Yii;
use yii\helpers\Json;

class Geocoder extends \yii\base\Component
{
    const FORMAT_OBJECT = 'object';
    
    public $clientId;
    
    public $format = self::FORMAT_OBJECT;
    
    public $resultClass = '\filsh\yii2\googleGeocoder\resources\Result';
    
    private $_service;
    
    public function init()
    {
        parent::init();
        $this->_service = (new \GoogleMapsGeocoder())
                ->setClientId($this->clientId)
                ->setFormat($this->format);
    }
    
    public function geocode($https = false, $raw = false)
    {
        if(!$this->isFormatObject()) {
            return $this->_service->geocode($https, $raw);
        }
        
        $format = $this->_service->getFormat();
        $this->_service->setFormat(\GoogleMapsGeocoder::FORMAT_JSON);
        $body = Json::decode($this->_service->geocode($https, true), true);
        $this->_service->setFormat($format);
        
        /* @var $response \filsh\yii2\googleGeocoder\service\Response */
        $response = Yii::createObject([
            'class' => '\filsh\yii2\googleGeocoder\service\Response',
            'itemClass' => $this->resultClass,
            'rawBody' => $body
        ]);
        
        if(!$response->isSuccess()) {
            throw new \RuntimeException('Invalid request.');
        }
        
        return $response;
    }
    
    /**
     * Whether the response format is Object.
     * @return bool whether Object
     */
    public function isFormatObject()
    {
      return $this->_service->getFormat() == self::FORMAT_OBJECT;
    }
    
    public function __call($name, $params)
    {
        if(method_exists($this->_service, $name)) {
            call_user_func_array([$this->_service, $name], $params);
            return $this;
        } else {
            return parent::__call($name, $params);
        }
    }
}