<?php

namespace App\Wallet;


use App\Wallet;
use Carbon\Carbon;

class Record extends Wallet
{
    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = new Carbon($value);
    }

    public function setAccount()
    {
        $account = Account::whereWalletId($this->wallet_account_id)->first();

        if($account)
        {
            $this->account()->associate($account);
        }
    }

    public function setCategory()
    {
        $category = Category::whereWalletId($this->wallet_category_id)->first();

        if($category)
        {
            $this->category()->associate($category);
        }
    }

    public function setCurrency()
    {
        $currency = Currency::whereWalletId($this->wallet_currency_id)->first();

        if($currency)
        {
            $this->currency()->associate($currency);
        }
    }
}
