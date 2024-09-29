<?php

namespace src\factory;
class SampleFactory
{
    public static function build():static
    {
        return new static();
    }
}