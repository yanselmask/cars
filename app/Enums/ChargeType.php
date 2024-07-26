<?php

namespace App\Enums;


enum ChargeType: int
{
    case POUNDS = 0;
    case KILOGRAMS = 1;

    public static function labels()
    {
        return [
            0 => __('Lb'),
            1 => __('Kg'),
        ];
    }
}
