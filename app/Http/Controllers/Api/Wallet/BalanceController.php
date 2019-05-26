<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Service\Wallet\Account\Client as Wallet;
use App\Http\Controllers\Controller;

class BalanceController extends Controller
{
    /** @var Wallet */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function getBalance($account_id = null)
    {
        return $this->wallet->getBalance($account_id);
    }
}
