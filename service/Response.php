<?php

namespace filsh\yii2\googleGeocoder\service;

use yii\base\Object;

class Response extends Object
{
    /**
     * Response raw body
     *
     * @var string
     */
    protected $body;
    
    /**
     * Result item class
     * 
     * @var string
     */
    protected $itemClass;
    
    /**
     * @return the $body
     */
    public function getRawBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setRawBody($body)
    {
        $this->body = $body;
    }
    
    /**
     * @return the $itemClass
     */
    public function getItemClass()
    {
        return $this->itemClass;
    }

    /**
     * @param string $itemClass
     */
    public function setItemClass($itemClass)
    {
        $this->itemClass = $itemClass;
    }
    
    /**
     * Return status
     * 
     * @return string
     * @throws \RuntimeException
     */
    public function getStatus()
    {
        if (!isset($this->body['status'])) {
            throw new \RuntimeException('Invalid status');
        }
        return $this->body['status'];
    }
    
    /**
     * Return results
     * @return \filsh\yii2\googleGeocoder\service\DataIterator
     */
    public function getResults()
    {
        if (!isset($this->body['results'])) {
            throw new \RuntimeException('Invalid results');
        }
        return new DataIterator($this->getItemClass(), $this->body['results']);
    }
}