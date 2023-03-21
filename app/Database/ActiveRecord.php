<?php

namespace App\Database;

abstract class ActiveRecord extends ActiveRecordActions
{
    public function __set($index, $value)
    {
        if (!isset($this->data[$index])) {
            $this->data[$index] = strip_tags($value);
        }
    }

    public function __get($index)
    {
        if (isset($this->data[$index])) {
            return $this->data[$index];
        }
    }

    public function getData()
    {
        return $this->data;
    }
}
