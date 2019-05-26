<?php

use Money\Money;
use Money\Currency;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\IntlMoneyFormatter;
use Money\Parser\IntlLocalizedDecimalParser;

if (! function_exists('money_to_cents')) {
    function money_to_cents($amount)
    {
        if(substr($amount, 0, 1) == "+" || substr($amount, 0, 1) == "+")
        {
          $amount = substr($amount, 1);
        }

        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('nl_NL', \NumberFormatter::DECIMAL);
        $moneyParser = new IntlLocalizedDecimalParser($numberFormatter, $currencies);

        $money = $moneyParser->parse($amount, new Currency('EUR'));

        return (int) $money->getAmount();
    }
}

if (! function_exists('cents_to_money')) {
    function cents_to_money($amount)
    {
        if(substr($amount, 0, 1) == "+" || substr($amount, 0, 1) == "+")
        {
          $amount = substr($amount, 1);
        }


        $money = new Money($amount, new Currency('EUR'));
        $currencies = new ISOCurrencies();

        $numberFormatter = new \NumberFormatter('nl_NL', \NumberFormatter::CURRENCY);
        $moneyFormatter = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }
}