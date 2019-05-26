<?php

namespace App\Http\Controllers\Api\Wallet;

use App\Http\Requests\Api\Wallet\Category\CreateRequest;
use App\Http\Requests\Api\Wallet\Category\UpdateRequest;
use App\Http\Service\Wallet\Category\Client as Wallet;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /** @var Wallet */
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index()
    {
        return $this->wallet->getCategories();
    }

    public function create(CreateRequest $request)
    {
        return $this->wallet->createCategory($request->validated());
    }

    public function show($id)
    {
        return $this->wallet->getCategory($id);
    }

    public function update(UpdateRequest $request, $id)
    {
        return $this->wallet->updateCategory($id, $request->validated());
    }
}
