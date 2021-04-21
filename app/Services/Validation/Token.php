<?php


namespace App\Services\Validation;


use Illuminate\Support\Facades\Log;

class Token
{
    const TOKEN_CODE = 'test';

    /**
     * @var string
     */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return bool
     */
    public function isValid(): bool
    {
        if ($this->token == self::TOKEN_CODE) {
            return true;
        }
        Log::error("Token: {$this->token} is not valid");
        return false;
    }
}
