<?php

namespace App\Http\Controllers;

use App\Services\Mailers\Mailer;
use App\Services\MailService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $obj = new MailService(new Mailer());
        $obj->sendMail('996708068599','Text message','test');
    }
}
