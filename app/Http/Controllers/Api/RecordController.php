<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Wallet\Record;

class RecordController extends ApiController
{
    public function index(){
        $builder = Record::query();

        $request = $this->buildRequest();
        $request->setAllowedIncludes('account');

        return $this->respond($builder, $request);
    }

    public function show($id){
        $builder = Record::whereId($id);

        $request = $this->buildRequest();
        $request->setAllowedIncludes('account', 'category', 'currency');

        return $this->respond($builder, $request);
    }
}
