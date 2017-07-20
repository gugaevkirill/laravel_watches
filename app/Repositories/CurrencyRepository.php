<?php

namespace App\Repositories;

use App\Models\Catalog\Product;
use Illuminate\Http\Request;

class CurrencyRepository
{
    // TODO: заменить на значения из ЦБ
    const TMP_USD_COURSE = 59.37;
    const TMP_EUR_COURSE = 68.40;
    // Округлять до десятков
    const ROUND_DIGITS = 10;

    const RUB = 'rub';
    const USD = 'usd';
    const EUR = 'eur';
    const ALLOWED_CURRENCIES = [self::RUB, self::USD, self::EUR];
    const SIGNS = [
        self::RUB => '₽',
        self::USD => '$',
        self::EUR => '€',
    ];

    /**
     * @var string
     */
    private $currency;

    /**
     * @param Request|null $request
     * @throws \Exception
     */
    public function __construct(Request $request = null)
    {
        $request = $request ?? Request::capture();

        $tmp = strtolower($request->cookie('currency', self::ALLOWED_CURRENCIES[0]));
        if (!in_array($tmp, self::ALLOWED_CURRENCIES)) {
            throw new \Exception('%s is not allowed currency' % $tmp);
        }

        $this->currency = strtolower($tmp);
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Отформатированная цена со знаком валюты
     * @param Product $product
     * @param string|null $currency
     * @return null|string
     */
    public function getProductPrice(Product $product, string $currency = null)
    {
        $currency = $currency ?? $this->currency;

        $codes = array_merge(
            [$currency],
            self::ALLOWED_CURRENCIES
        );

        foreach ($codes as $code) {
            $propertyName = Product::PRICE_PREFIX . $code;

            if (isset($product->$propertyName)) {
                return $this->formatPrice(
                    $this->convertPrice($product->$propertyName, $code, $currency),
                    $currency
                );
            }
        }

        return null;
    }

    /**
     * Преобразование цены с округлением
     * @param int $price
     * @param string $from
     * @param string $to
     * @return int
     */
    private function convertPrice(int $price, string $from, string $to): int
    {
        if ($from == $to) {
            return $price;
        }

        $rubPrice = $from == self::RUB
            ? $price
            : $price * constant(self::class . "::TMP_" . strtoupper($from) . "_COURSE");
        
        if ($to == self::RUB) {
            return $rubPrice;
        }

        return $rubPrice / constant(self::class . "::TMP_" . strtoupper($to) . "_COURSE");
    }

    /**
     * Разделяет цену пробелами и добавляет знак валюты
     * @param int $price
     * @param string|null $currency
     * @return string
     */
    private function formatPrice(int $price, string $currency = null)
    {
        $currency = $currency ?? $this->currency;
        $amount = ceil($price / self::ROUND_DIGITS) * self::ROUND_DIGITS;

        return number_format($amount, 0, '.', ' ')
            . ' '
            . self::SIGNS[$currency];
    }
}