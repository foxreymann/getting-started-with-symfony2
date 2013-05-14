<?php
namespace Sensio\Bundle\TrainingBundle\Converter;

class CelsiusConverter
{
    public function toFahrenheit($value)
    {
        return ($value * 9) / 5 + 32;
    }
}
