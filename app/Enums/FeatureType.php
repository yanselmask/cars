<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FeatureType: int implements HasColor, HasLabel
{
    case INTERIOR = 0;
    case EXTERIOR = 1;
    case SAFETY = 2;

    case TECHNOLOGY = 3;

    public static function labels()
    {
        return [
            0 => __('Interior'),
            1 => __('Exterior'),
            2 => __('Safety'),
            3 => __('Technology')
        ];
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getLabelCapitalize(): ?string
    {
        return ucfirst($this->getLabelToLower());
    }

    public function getLabelToLower(): ?string
    {
        return strtolower($this->name);
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::INTERIOR => 'primary',
            self::EXTERIOR => 'success',
            self::SAFETY => 'warning',
            self::TECHNOLOGY => 'info',
        };
    }
}
