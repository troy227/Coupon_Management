<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Coupon;
class MailController extends Controller
{
    public function basic_email(Request $request)
    {
        $data = ['name' => $request->user()->name];
        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('troy2271999@gmail.com', 'Coupon')->subject
            ('Coupon About to Expire');
            $message->from('troy22719999@gmail.com', 'Coupon Admin');
        });
    }
}
