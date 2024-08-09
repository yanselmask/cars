<?php


namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ListingStatus: int implements HasLabel, HasColor
{
    case PENDING = 0;
    case APPROVED = 1;
    case REJECTED = 2;

    case EXPIRATED = 3;

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::APPROVED => 'success',
            self::REJECTED => 'danger',
            self::EXPIRATED => 'secondary',
        };
    }

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public static function getLabels()
    {
        return [
            0 => __('Pending'),
            1 => __('Approved'),
            2 => __('Rejected'),
            3 => __('Expirated'),
        ];
    }
}
