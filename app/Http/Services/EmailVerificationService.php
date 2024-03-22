<?php

namespace App\Http\Services;
use Illuminate\Http\Request;

interface EmailVerificationService
{

    public function sendVerificationLink(object $user);

}
