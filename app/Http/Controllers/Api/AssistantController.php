<?php


namespace App\Http\Controllers\Api;


use App\Assistant\RequestHandler\SimpleRequestHandler;
use App\Http\Controllers\ApiController;
use MaxBeckers\GoogleActions\Exception\InvalidRequestException;
use MaxBeckers\GoogleActions\Exception\MissingRequestHandlerException;
use MaxBeckers\GoogleActions\Request\Request;
use MaxBeckers\GoogleActions\RequestHandler\RequestHandlerRegistry;
use MaxBeckers\GoogleActions\Validation\RequestValidator;

class AssistantController extends ApiController
{

    public function fulfillAction(Request $googleRequest)
    {
        try {
            // Request validation
            $validator = new RequestValidator();
            $validator->validate($googleRequest);
            // add handlers to registry
            $mySimpleRequestHandler = new SimpleRequestHandler();
            $requestHandlerRegistry = new RequestHandlerRegistry();
            $requestHandlerRegistry->addHandler($mySimpleRequestHandler);
            $response = $requestHandlerRegistry->getSupportingHandler($googleRequest)->handleRequest($googleRequest);

            return response()->json($response);
        } catch (MissingRequestHandlerException $e) {
            dd($e->getMessage());
        } catch (InvalidRequestException $e) {
            dd($e->getMessage());
        }
    }

}
