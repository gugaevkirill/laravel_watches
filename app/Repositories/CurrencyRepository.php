<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class CurrencyRepository
{
    const CURRENCY_DEFAULT = 'RUB';

    const ALLOWED_CURRENCIES = ['RUB', 'USD', 'EUR'];

    /**
     * @var string
     */
    private $currency;

    public function __construct(Request $request = null)
    {
        $request = $request ?? Request::capture();

        $tmp = $request->cookie('currency', self::CURRENCY_DEFAULT);
        if (!in_array($tmp, self::ALLOWED_CURRENCIES)) {
            throw new \Exception('%s is not allowed currency' % $tmp);
        }

        $this->currency = strtolower($tmp);
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}