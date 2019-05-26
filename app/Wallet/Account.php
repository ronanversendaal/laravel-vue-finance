<?php

namespace App\Wallet;

use App\Wallet;

class Account extends Wallet
{
    public function records(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Record::class);
    }

    public function setBalance($value)
    {
        $this->attributes['balance'] = $value;
    }
}
