<?php


namespace App\Services;


interface IMailer
{
    public function sendTo(string $phoneNumber, string $text);
}
