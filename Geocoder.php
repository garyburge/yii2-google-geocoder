<?php

namespace filsh\yii2\googleGeocoder;

use Yii;
use yii\helpers\Json;

class Geocoder extends \yii\base\Component
{
    const FORMAT_OBJECT = 'object';
    
    public $clientId;
    
    public $format = self::FORMAT_OBJECT;
    
    public $responseClass = '\filsh\yii2\googleGeocoder\service\Response';
    
    public $resultClass = '\filsh\yii2\googleGeocoder\resources\Result';
    
    private $_service;
    
    public function getService()
    {
        if($this->_service === null) {
            $this->_service = (new \GoogleMapsGeocoder())
                ->setClientId($this->clientId)
                ->setFormat($this->format);
        }
        return $this->_service;
    }
    
    public function geocode($https = false, $raw = false)
    {
        $service = $this->getService();
        if(!$this->isFormatObject()) {
            return $service->geocode($https, $raw);
        }
        
        $format = $service->getFormat();
        $service->setFormat(\GoogleMapsGeocoder::FORMAT_JSON);
        $body = Json::decode($service->geocode($https, true), true);
        $service->setFormat($format);
        
        /* @var $response \filsh\yii2\googleGeocoder\service\Response */
        $response = Yii::createObject([
            'class' => $this->responseClass,
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
      return $this->getService()->getFormat() == self::FORMAT_OBJECT;
    }
    
    public function __call($name, $params)
    {
        if(method_exists($this->getService(), $name)) {
            call_user_func_array([$this->getService(), $name], $params);
            return $this;
        } else {
            return parent::__call($name, $params);
        }
    }
}