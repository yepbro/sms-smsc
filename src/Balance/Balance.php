<?php

namespace Yepbro\Smsc\Balance;

use Yepbro\Smsc\Enums\Currency;

/**
 * DTO для передачи информации о балансе
 */
class Balance
{
    public function __construct(
        public readonly ?float     $balance,
        public readonly ?Currency  $currency,
        protected readonly ?string $responseBody,
        protected readonly ?int    $responseCode,
    )
    {
        //
    }

    public function getResponseBody(): ?string
    {
        return $this->responseBody;
    }

    public function getResponseCode(): ?int
    {
        return $this->responseCode;
    }


}