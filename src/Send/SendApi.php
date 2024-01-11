<?php

namespace Yepbro\Smsc\Send;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Yepbro\Smsc\Send\Enums\Cost;
use Yepbro\Smsc\Send\Enums\Format;

class SendApi
{
    protected string $endpoint = 'https://smsc.ru/sys/send.php';

    public function __construct(
        public readonly string $login,
        public readonly string $password,
        public readonly Client $client,
    )
    {
        //
    }

    /**
     * Проверить номера телефонов на доступность отправкой HLR-запрос
     *
     * @throws GuzzleException
     */
    public function hlr(string $phone): bool
    {
        $response = $this->client->post($this->endpoint, [
            'form_params' => [
                'login' => $this->login,
                'psw' => $this->password,
                'phones' => $phone,
                'hlr' => 1,
                'fmt' => Format::JSON->value,
                'cost' => Cost::DEFAULT->value,
            ]
        ]);

        $content = $response->getBody()->getContents();

        $data = json_decode($content, true);

        return $data && isset($data['id']);
    }
}