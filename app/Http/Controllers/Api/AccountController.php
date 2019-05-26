<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Wallet\Account;

class AccountController extends ApiController
{
    public function index(){
        $builder = Account::query();

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }

    public function show($id){
        $builder = Account::whereId($id);

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }
}
