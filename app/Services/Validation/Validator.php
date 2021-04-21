<?php

namespace App\Services\Validation;

class Validator
{
    /**
     * @var Token
     */
    private $token;

    /**
     * @var CountRequestsPerMinute
     */
    private $countRequestsPerMinute;
    /**
     * @var Phone
     */
    private $phone;

    /**
     * Validator constructor.
     * @param Token $token
     * @param CountRequestsPerMinute $countRequestsPerMinute
     * @param Phone $phone
     */
    public function __construct(
        Token $token,
        CountRequestsPerMinute $countRequestsPerMinute,
        Phone $phone
    )
    {
        $this->token = $token;
        $this->countRequestsPerMinute = $countRequestsPerMinute;
        $this->phone = $phone;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function isValid(): bool
    {
        return $this->countRequestsPerMinute->isValid() && $this->token->isValid() && $this->phone->isValid();
    }
}
