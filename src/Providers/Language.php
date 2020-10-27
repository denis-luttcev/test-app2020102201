<?php
declare(strict_types=1);

namespace App\Providers;

/**
 * Declares awailable response languages
 * Based on request description from API docs:
 * https://yandex.ru/dev/weather/doc/dg/concepts/forecast-test.html#req-format
 */
class Language {
    const RU = 'ru_RU';
    const RUUA= 'ru_UA';
    const UK= 'uk_UA';
    const BE = 'be_BY';
    const KK = 'kk_KZ';
    const TR = 'tr_TR';
    const EN = 'en_US';
}
