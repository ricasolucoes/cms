<?php

namespace Cms\Services;

class Normalizer
{
    public function __construct($value)
    {
        $this->value = $value;
    }

    public function __toString()
    {
        if (is_null($this->value)) {
            return "";
        }

        return $this->value;
    }

    public function plain(): string
    {
        return strip_tags($this->value);
    }
}
