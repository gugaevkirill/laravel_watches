<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class CurrencyRepository
{
    const CURRENCY_DEFAULT = 'RUB';

    /**
     * @var string
     */
    private $currency;

    public function __construct(Request $request = null)
    {
        $request = $request ?? Request::capture();
        $this->currency = $request->cookie('currency', self::CURRENCY_DEFAULT);
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }
}