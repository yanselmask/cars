<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum  Status: int implements HasLabel, HasColor
{
    case DRAFT = 0;
    case PUBLISHED = 1;
    case PENDING = 2;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::DRAFT => 'info',
            self::PUBLISHED => 'success',
            self::PENDING => 'warning',
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public static function getLabels()
    {
        return [
            0 => __('Draft'),
            1 => __('Published'),
            2 => __('Pending'),
        ];
    }
}
