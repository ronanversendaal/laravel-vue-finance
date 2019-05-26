<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Wallet extends Model
{
    private function build($data)
    {
        array_walk($data, function(& $item, $key){

            $map = [
                'id' => 'wallet_id',
                'categoryId' => 'wallet_category_id',
                'accountId' => 'wallet_account_id',
                'currencyId' => 'wallet_currency_id'
            ];

            if (array_key_exists($key, $map)) {
                $this->{$map[$key]} = $item;
            } else {
                $this->{Str::snake($key)} = $item;
            }

        });

        return $this;
    }

    public function buildAndCreate($data)
    {
        $model = $this->build($data);

        if($existing = self::whereWalletId($this->wallet_id)->first())
        {
            Model::unguarded(function () use ($existing, $model) {
                $existing->update($model->toArray());
            });

            $model = $existing;
        } else {
            $model->save();
        }

        return $model;
    }
}
