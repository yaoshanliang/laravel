<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use App\Exceptions\ApiRequestException;
use Validator;

class Controller extends BaseController
{
    public function apiValidate($input, $rules)
    {
        $validator = Validator::make($input->all(), $rules);
        if ($validator->fails()) {
            throw new ApiRequestException($validator->messages()->first());
        }
    }
}
