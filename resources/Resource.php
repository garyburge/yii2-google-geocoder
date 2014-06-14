<?php

namespace filsh\yii2\googleGeocoder\resources;

abstract class Resource
{
    protected $data;
    
    /**
     * Contructor
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}