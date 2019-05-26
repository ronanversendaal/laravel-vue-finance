<?php
namespace App\Http\Service\Wallet\Account;

use App\Http\Service\Wallet\Client as BaseClient;

class Client extends BaseClient
{
    public function getAccounts()
    {
        return $this->request('accounts');
    }

    public function getAccount($id)
    {
        return $this->request('account/'.$id);
    }

    public function createAccount($data)
    {
        return $this->request('account', 'POST', json_encode($data), ['Content-Type' => 'application/json']);
    }

    public function updateAccount($id, $data)
    {
        return $this->request('account/'.$id, 'PUT', json_encode($data), ['Content-Type' => 'application/json']);
    }

    public function deleteAccount($id)
    {
        return $this->request('account/'.$id, 'DELETE');
    }

    public function getBalance($id = null)
    {
        $uri = 'balance';

        if ($id !== null) {
            $uri .= '/account/'.$id;
        }
        return $this->request($uri);
    }
}
