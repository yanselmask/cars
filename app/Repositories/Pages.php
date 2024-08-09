<?php

namespace App\Repositories;

use App\Models\Page;

class Pages implements PagesInterface
{
    public function findById($id)
    {
        return Page::published()
            ->where('id', $id)
            ->with('user')
            ->first();
    }
}
