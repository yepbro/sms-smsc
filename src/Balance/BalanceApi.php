<?php

namespace Yepbro\Smsc\Balance;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Yepbro\Smsc\Balance\Enums\CurrencyFlag;
use Yepbro\Smsc\Balance\Enums\Format;

/**
 * Работа с данными баланса в сервисе
 */
class BalanceApi
{
    protected string $endpoint = 'https://smsc.ru/sys/balance.php';

    /**
     * @var Format Формат ответа сервера
     */
    protected Format $format = Format::STRING;

    /**
     * @var CurrencyFlag Флаг, указывающий на необходимость добавления в ответ сервера названия валюты Клиента
     */
    protected CurrencyFlag $currency = CurrencyFlag::YES;

    public function __construct(
        public readonly string $login,
        public readonly string $password,
        public readonly Client $client,
    )
    {
        //
    }

    /**
     * Получить значение текущего баланса
     *
     * @see https://smsc.ru/api/http/balance/get_balance
     * @throws GuzzleException
     */
    public function get(): Balance
    {
        $response = $this->client->post($this->endpoint, [
            'form_params' => [
                'login' => $this->login,
                'psw' => $this->password,
                'cur' => $this->currency->value,
                'fmt' => $this->format->value,
            ]
        ]);

        $content = $response->getBody()->getContents();

        list($balance, $currency) = (new ResponseParser)($content, $this->format);

        return new Balance(
            $balance,
            $currency,
            $content,
            $response->getStatusCode(),
        );
    }

    /**
     * Задать формат, в котором должны получаться данные о балансе
     */
    public function format(Format $format): BalanceApi
    {
        $this->format = $format;

        return $this;
    }

    /**
     * Получать вместе с данными баланса информацию в какой он валюте
     */
    public function currency(CurrencyFlag $currency): BalanceApi
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Изменить точку входа для метода получения баланса
     */
    public function endpoint(string $url): BalanceApi
    {
        $this->endpoint = $url;

        return $this;
    }
}