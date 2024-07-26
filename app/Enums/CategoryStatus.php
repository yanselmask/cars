<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum CategoryStatus: int implements HasLabel, HasColor
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case PENDING = 2;

    public static function labels()
    {
        return [
            0 => __('Draft'),
            1 => __('Published'),
            2 => __('Pending'),
        ];
    }

    public static function colors()
    {
        return  [
            0 => 'info',
            1 => 'success',
            2 => 'warning',
        ];
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::DRAFT => 'info',
            self::PUBLISHED => 'success',
            self::PENDING => 'warning',
        };
    }

    public static function color($color)
    {
        return match ($color) {
            self::DRAFT => 'info',
            self::PUBLISHED => 'success',
            self::PENDING => 'warning',
            default => 'success'
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
