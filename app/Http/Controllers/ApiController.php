<?php

namespace App\Http\Controllers;

use App\Http\ApiRequest;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\Exceptions\InvalidFilterQuery;
use Spatie\QueryBuilder\Exceptions\InvalidIncludeQuery;

class ApiController extends Controller
{
    public function respond($resource, $request)
    {
        $builder = QueryBuilder::for($resource);

        $builder
            ->allowedIncludes($request->getAllowedIncludes())
            ->allowedFilters($request->getAllowedFilters());

        if ($request->hasDefaultSort()) {
            $builder->defaultSort($request->getDefaultSort());
        }

        if ($request->hasAllowedSorts()) {
            $builder->allowedSorts($request->getAllowedSorts());
        }

        if ($request->hasAllowedFields()) {
            $builder->allowedFields($request->getAllowedFields());
        }

        if($builder->count() === 1){
            return $builder->firstOrFail();
        }

        return $builder->get()->toArray();
    }

    protected function buildRequest($arguments = [])
    {
        return new ApiRequest($arguments);
    }
}
