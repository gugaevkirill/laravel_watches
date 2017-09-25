<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;
use App\Models\Catalog\Product;
use Illuminate\Http\Request;

class CurrencyRepository
{
    // Округлять до десятков
    const ROUND_DIGITS = 2;

    const RUB = 'rub';
    const USD = 'usd';
    const EUR = 'eur';
    const ALLOWED_CURRENCIES = [self::USD, self::RUB, self::EUR];
    const SIGNS = [
        self::RUB => '₽',
        self::USD => '$',
        self::EUR => '€',
    ];

    const CENTROBANK_URL = 'https://www.cbr-xml-daily.ru/daily_json.js';

    const REDIS_KEY = 'currency:cource';
    const REDIS_TIME_KEY = 'timestamp';
    const REDIS_TTL = 60 * 60 * 24;

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
            : $price * $this->getCource($from);
        
        if ($to == self::RUB) {
            return $rubPrice;
        }

        return $rubPrice / $this->getCource($to);
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

    /**
     * Обновить курсы валют с ЦБ, записать в Redis и вернуть в массиве
     * @throws \Exception
     */
    public function updateCources(): array
    {
        if (!$json_daily = file_get_contents(self::CENTROBANK_URL)) {
            throw new \Exception('Cources not available');
        };

        $data = json_decode($json_daily);
        $result = [];

        foreach (CurrencyRepository::ALLOWED_CURRENCIES as $curr) {
            if ($curr == CurrencyRepository::RUB) {
                continue;
            }

            $value = $data->Valute->{strtoupper($curr)}->Value;

            $result[$curr] = $value;
            Redis::hset(self::REDIS_KEY, $curr, $value);
        }

        $result[self::REDIS_TIME_KEY] = time();
        Redis::hset(self::REDIS_KEY, self::REDIS_TIME_KEY, time());

        return $result;
    }

    /**
     * Получает курс валют из редиса и обновляет при необходимости
     * @param string $currency
     * @return float
     * @throws \Exception
     */
    private function getCource(string $currency): float
    {
        $data = Redis::hgetAll(self::REDIS_KEY);

        if (time() - $data[self::REDIS_TIME_KEY] > self::REDIS_TTL) {
            try {
                $data = $this->updateCources();
            } catch (\Exception $e) {
                // Если облажались с обновлением курса, следующую попытку будем делать через день.
                Redis::hset(self::REDIS_KEY, self::REDIS_TIME_KEY, time());
                throw $e;
            }
        }

        return floatval($data[$currency]);
    }
}