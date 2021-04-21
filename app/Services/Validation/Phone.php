<?php


namespace App\Services\Validation;


use Illuminate\Support\Facades\Log;

class Phone
{
    /**
     * @var string
     */
    private $number;

    /**
     * Phone constructor.
     * @param string $phone
     */
    public function __construct(string $phone)
    {
        $this->number = $phone;
    }

    public function isValid(): bool
    {
        if (preg_match('/^[0-9]{12}+$/', $this->number)){
            return true;
        }
        Log::error("Phone number: {$this->number} is not valid");
        return false;
    }
}
