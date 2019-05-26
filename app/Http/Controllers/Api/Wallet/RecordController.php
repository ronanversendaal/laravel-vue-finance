<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Requests\Api\Wallet\Record\CreateBulkRequest;
use App\Http\Requests\Api\Wallet\Record\UpdateRequest;
use App\Http\Service\Wallet\Record\Client as Wallet;
use App\Http\Controllers\Controller;

class RecordController extends Controller
{
    /** @var Wallet */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index()
    {
        return $this->wallet->getRecords();
    }

    public function create(CreateBulkRequest $request)
    {
        return $this->wallet->createRecords($request->validated());
    }

    public function show($id)
    {
        return $this->wallet->getRecord($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->wallet->updateRecord($id, $request->validated());
    }
}
