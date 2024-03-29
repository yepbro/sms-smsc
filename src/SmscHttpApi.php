<?php

namespace Yepbro\Smsc;

use GuzzleHttp\Client;
use Yepbro\Smsc\Balance\BalanceApi;
use Yepbro\Smsc\Send\SendApi;

class SmscHttpApi
{
    protected Client $client;

    public function __construct(
        public readonly string $login,
        public readonly string $password,
        ?Client $client = null,
    )
    {
        if (is_null($client)) {
            $this->client = new Client;
        }
    }

    /**
     * API баланса
     */
    public function balance(): BalanceApi
    {
        return new BalanceApi($this->login, $this->password, $this->client);
    }

    /**
     * API работы с отправкой сообщений
     */
    public function sender(): SendApi
    {
        return new SendApi($this->login, $this->password, $this->client);
    }
}