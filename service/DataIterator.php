<?php

namespace filsh\yii2\googleGeocoder\service;

use Yii;
use yii\base\ArrayAccessTrait;

class DataIterator implements \Iterator, \ArrayAccess, \Countable
{
    use ArrayAccessTrait;
    
    protected $itemClass;
    
    protected $count;
    
    protected $current;

    protected $data = array();
    
    protected $dataKeys;
    
    public function __construct($itemClass, $data)
    {
        $this->itemClass = $itemClass;
        $this->data = $data;
    }
    
    public function current()
    {
        $data = $this->data[$this->dataKeys[$this->current]];
        return new $this->itemClass($data);
    }

    public function key()
    {
        return $this->current;
    }

    public function next()
    {
        ++$this->current;
    }

    public function rewind()
    {
        $this->dataKeys = array_keys($this->data);
        $this->current = 0;
        $this->count = count($this->data);
    }

    public function valid()
    {
        return $this->count > $this->current;
    }

    public function count()
    {
        return count($this->data);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? new $this->itemClass($this->data[$offset]) : null;
    }
}