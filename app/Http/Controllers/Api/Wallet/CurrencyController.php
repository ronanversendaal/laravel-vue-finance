<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Service\Wallet\Currency\Client as Wallet;
use App\Http\Controllers\Controller;

class CurrencyController extends Controller
{
    /** @var Wallet */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index()
    {
        return $this->wallet->getCurrencies();
    }

    public function show($id)
    {
        return $this->wallet->getCurrency($id);
    }
}
