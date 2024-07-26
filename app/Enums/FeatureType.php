<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FeatureType: int implements HasColor, HasLabel
{
    case INTERIOR = 0;
    case EXTERIOR = 1;
    case SAFETY = 2;

    public static function labels()
    {
        return [
            0 => __('Interior'),
            1 => __('Exterior'),
            2 => __('Safety')
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::INTERIOR => 'info',
            self::EXTERIOR => 'success',
            self::SAFETY => 'warning',
        };
    }
}
