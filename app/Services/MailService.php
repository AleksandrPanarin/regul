<?php

namespace App\Services;

use App\Services\Validation\CountRequestsPerMinute;
use App\Services\Validation\Phone;
use App\Services\Validation\Token;
use App\Services\Validation\Validator;
use Illuminate\Support\Facades\Log;
use App\Models\Log as ModelLog;
use Illuminate\Support\Facades\Mail;
use Monolog\Logger;

class MailService
{
    /**
     * @var IMailer
     */
    private $mailer;

    /**
     * MailService constructor.
     * @param IMailer $mailer
     */
    public function __construct(IMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param string $phoneNumber
     * @param string $text
     * @param string $token
     */
    public function sendMail(string $phoneNumber, string $text, string $token): void
    {
        $isProd = env('APP_ENV') == 'prod';
        try {
            $validator = new Validator(new Token($token), new CountRequestsPerMinute(), new Phone($phoneNumber));
            if ($validator->isValid()) {
                if ($isProd) {
//                    TODO: работает отправка для моего номера 996708068599
//                    $this->mailer->sendTo($phoneNumber, $text);
                    echo "send to $phoneNumber message: $text";
                } else {
                    $message = 'Send message to ' . $phoneNumber . ' with text: ' . $text;
                    Log::info($message);
                }
            } else {
                throw new \Exception('Validation failed: Token not valid or request limit exceeded');
            }
        } catch (\Exception $e) {
            if ($isProd) {
                $log = new ModelLog();
                $log->type = Logger::getLevelName(Logger::ERROR);
                $log->message = $e->getMessage();
                $log->save();
            } else {
                $errorMessage = 'Throw exception with message: ' . $e->getMessage();
                Log::error($errorMessage);
            }
        }
    }

}
