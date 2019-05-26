<?php

namespace App\Wallet;

use App\Wallet;

class Category extends Wallet
{
    public function records()
    {
        $this->hasMany(Record::class);
    }
}
