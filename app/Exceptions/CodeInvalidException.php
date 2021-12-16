<?php

namespace App\Exceptions;

use Exception;

class CodeInvalidException extends Exception
{
    public function render($request)
    {
        session()->flash('success', 'Invalid Coupon Code, some of the users do not exist');
        return redirect('/coupons');
    }
}
