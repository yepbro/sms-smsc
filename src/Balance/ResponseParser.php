<?php

namespace Yepbro\Smsc\Balance;

use Yepbro\Smsc\Balance\Enums\Format;
use Yepbro\Smsc\Balance\ResponseParsers\JsonParser;
use Yepbro\Smsc\Balance\ResponseParsers\StringParser;
use Yepbro\Smsc\Balance\ResponseParsers\XmlParser;
use Yepbro\Smsc\Enums\Currency;

class ResponseParser
{
    public function __invoke(?string $content, Format $format): array
    {
        $data = match ($format) {
            Format::XML => (new XmlParser)($content),
            Format::JSON => (new JsonParser)($content),
            Format::STRING => (new StringParser)($content),
        };

        return [
            $data['balance'],
            Currency::tryFrom($data['currency']),
        ];
    }
}