<?php

use App\Account;
use Wzulfikar\EloquentSimpleLedger\LedgerHelper;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('transactions')->group(function () {
    Route::get('', 'Api\TransactionController@index');
});

Route::prefix('account/{account}')->group(function (){

    Route::model('account', Account::class);

    Route::get('', 'Api\AccountController@index');

    Route::prefix('ledgers')->group(function(){
    Route::get('summary', function($account) {
        return LedgerHelper::summary($account);
    });

    Route::get('', 'Api\AccountLedgerController@index');

    Route::get('all', function($account){
        return LedgerHelper::accountStats($account);
    });
});

});

Route::group(['prefix' => 'assistant'], function (){
    Route::get('fulfill', 'Api\AssistantController@fulfillAction');
});


Route::group(['prefix' => 'accounts'] , function(){

    Route::get('' , 'Api\AccountController@index');
    Route::get('/{account_id}', 'Api\AccountController@show');
});

Route::group(['prefix' => 'categories'] , function(){

    Route::get('' , 'Api\CategoryController@index');
    Route::get('/{category_id}', 'Api\CategoryController@show');
});

Route::group(['prefix' => 'currencies'] , function(){

    Route::get('' , 'Api\CurrencyController@index');
    Route::get('/{currency_id}', 'Api\CurrencyController@show');

});

Route::group(['prefix' => 'records'] , function(){

    Route::get('' , 'Api\RecordController@index');
    Route::get('/{record_id}', 'Api\RecordController@show');

});

Route::group(['prefix' => 'balance'] , function(){

    Route::get('{account_id?}' , 'Api\BalanceController@getBalance');

});

Route::group(['prefix' => 'wallet'] , function(){

    Route::group(['prefix' => 'accounts'] , function(){

        Route::get('' , 'Api\Wallet\AccountController@index');
        Route::post('' , 'Api\Wallet\AccountController@create');

        Route::get('/{account_id}', 'Api\Wallet\AccountController@show');
        Route::put('/{account_id}', 'Api\Wallet\AccountController@update');
        Route::delete('/{account_id}', 'Api\Wallet\AccountController@delete');
    });

    Route::group(['prefix' => 'categories'] , function(){

        Route::get('' , 'Api\Wallet\CategoryController@index');
        Route::post('' , 'Api\Wallet\CategoryController@create');

        Route::get('/{category_id}', 'Api\Wallet\CategoryController@show');
        Route::put('/{category_id}', 'Api\Wallet\CategoryController@update');
        Route::delete('/{category_id}', 'Api\Wallet\CategoryController@delete');
    });

    Route::group(['prefix' => 'currencies'] , function(){

        Route::get('' , 'Api\Wallet\CurrencyController@index');
        Route::post('' , 'Api\Wallet\CurrencyController@create');

        Route::get('/{currency_id}', 'Api\Wallet\CurrencyController@show');
        Route::put('/{currency_id}', 'Api\Wallet\CurrencyController@update');
        Route::delete('/{currency_id}', 'Api\Wallet\CurrencyController@delete');

    });

    Route::group(['prefix' => 'records'] , function(){

        Route::get('' , 'Api\Wallet\RecordController@index');
        Route::post('' , 'Api\Wallet\RecordController@create');

        Route::get('/{record_id}', 'Api\Wallet\RecordController@show');
        Route::put('/{record_id}', 'Api\Wallet\RecordController@update');
        Route::delete('/{record_id}', 'Api\Wallet\RecordController@delete');

    });

    Route::group(['prefix' => 'balance'] , function(){

        Route::get('{account_id?}' , 'Api\Wallet\BalanceController@getBalance');

    });
});
