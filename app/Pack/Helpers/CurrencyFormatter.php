<?php

namespace App\Pack\Helpers;

class CurrencyFormatter
{
    public static function parse($amount): bool|string
    {
        return numfmt_format_currency(numfmt_create('en_NG', \NumberFormatter::CURRENCY), $amount, "NGN");
    }
}
