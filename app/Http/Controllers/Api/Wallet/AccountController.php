<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Requests\Api\Wallet\Account\CreateRequest;
use App\Http\Service\Wallet\Account\Client as Wallet;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /** @var Wallet */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index()
    {
        return $this->wallet->getAccounts();
    }

    public function show($id)
    {
        return $this->wallet->getAccount($id);
    }

    public function create(CreateRequest $request)
    {
        return $this->wallet->createAccount($request->validated());
    }

    public function update(CreateRequest $request, $id)
    {
        return $this->wallet->updateAccount($id, $request->validated());
    }

    public function delete($id)
    {
        return $this->wallet->deleteAccount($id);
    }
}
