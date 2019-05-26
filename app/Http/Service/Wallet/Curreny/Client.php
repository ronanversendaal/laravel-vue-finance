<?php
namespace App\Http\Service\Wallet\Currency;

use App\Http\Service\Wallet\Client as BaseClient;

class Client extends BaseClient
{
    public function getCurrencies()
    {
        return $this->request('currencies');
    }

    public function getCurrency($id)
    {
        return $this->request('currency/'.$id);
    }

    public function deleteCurrency($id)
    {
        return $this->request('currency/'.$id,  'DELETE');
    }
}
