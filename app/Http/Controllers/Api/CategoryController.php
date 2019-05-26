<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Wallet\Category;

class CategoryController extends ApiController
{
    public function index(){
        $builder = Category::query();

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }

    public function show($id){
        $builder = Category::whereId($id);

        $request = $this->buildRequest();
        $request->setAllowedIncludes('records');

        return $this->respond($builder, $request);
    }
}
