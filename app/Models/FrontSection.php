<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontSection extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $casts = [
        'data_values' => 'json'
    ];


    public function pages()
    {
        return $this->belongsToMany(Page::class)->withPivot('sort_order');
    }
}
