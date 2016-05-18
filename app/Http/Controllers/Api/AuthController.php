<?php

namespace Quill\Http\Controllers\Api;

use Quill\Forms\RegisterForm;

use Illuminate\Http\Request;

class AuthController extends ApiController
{
    /**
     * Validates the registration form and returns the errors
     * (if any are present) in JSON format.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postValidateRegisterForm(Request $request)
    {
        // @TODO Refactor - Make reusable!
        $validator = \Validator::make($request->all(), RegisterForm::$rules);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return ['successful' => false, 'errors' => $errors];
        }

        return ['successful' => true];
    }
}