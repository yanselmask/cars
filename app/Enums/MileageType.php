<?php

namespace App\Enums;


enum MileageType: int
{
    case MILES = 0;
    case KILOMETRES = 1;
    case HOURS = 2;

    public static function labels()
    {
        return [
            0 => __('Miles'),
            1 => __('Kms'),
            2 => __('Hours'),
        ];
    }

    public static function getLabel($label)
    {
        return match ($label) {
            0 => __('Miles'),
            1 => __('Kms'),
            2 => __('Hours'),
        };
    }
}
