<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class LangRepository
{
    const DEFAULT_LOCALE = 'ru';

    /**
     * @var Request
     */
    private $request;
    /**
     * @var string
     */
    private $subdomain;
    /**
     * @var array
     */
    private $locales;

    public function __construct(Request $request = null)
    {
        $this->request = $request ?? Request::capture();
        $this->locales = array_keys(config('backpack.crud.locales'));
    }

    /**
     * @return string
     */
    public function getSubdomain(): string
    {
        if (isset($this->subdomain)) {
            return $this->subdomain;
        }

        $url_array = explode(
            '.',
            parse_url($this->request->url(), PHP_URL_HOST)
        );

        // Если поддомен не указан
        if (count($url_array) == 1 || $url_array[0] == 'elitebazaar') {
            return $this->subdomain = '';
        }

        return $this->subdomain = $url_array[0];
    }

    /**
     * Совпадает ли сабдомен с одной из разрешенных локалей
     * @return bool
     */
    public function isValidSubdomain(): bool
    {
        return in_array($this->getSubdomain(), array_keys($this->locales));
    }

    /**
     * Если перешли на сабдомен дефолтной локали, нужен редирект
     * @return bool
     */
    public function isRedirectRequired(): bool
    {
        return self::DEFAULT_LOCALE == $this->getSubdomain();
    }

    /**
     * Убирает дефолтную локаль из URL.
     * Если указана локаль, генерит URL сайта для этой локали
     * @param string $locale
     * @return string
     */
    public function getRedirectUrl(string $locale = null): string
    {
        $pattern = $this->getSubdomain()
            ? "/(https?):\/\/{$this->getSubdomain()}\./i"
            : "/(https?):\/\//i";

        if ($this->isRedirectRequired()
            || $locale == self::DEFAULT_LOCALE
            || !isset($locale)
        ) {
            $replacement = '$1://';
        } else {
            $replacement = "$1://$locale.";
        }

        return preg_replace($pattern, $replacement, $this->request->fullUrl());
    }

    /**
     * @return array
     */
    public function getLocalesAsArray(): array
    {
        $locales = [];

        foreach (config('backpack.crud.locales') as $code => $name) {
            $tmp = [
                'code' => $code,
                'name' => $name,
                'url' => $this->getRedirectUrl($code),
            ];

            // Помещаем текущую локаль в начало
            if ($code == $this->subdomain) {
                array_unshift($locales, $tmp);
            } else {
                $locales[] = $tmp;
            }
        }

        return $locales;
    }

    /**
     * @return string
     */
    public function getLocale(): string
    {
        return \App::getLocale() ?: self::DEFAULT_LOCALE;
    }
}
