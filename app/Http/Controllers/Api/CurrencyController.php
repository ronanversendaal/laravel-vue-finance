<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Wallet\Currency;

class CurrencyController extends ApiController
{
    public function index(){
        $builder = Currency::query();

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }

    public function show($id){
        $builder = Currency::whereId($id);

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }
}
