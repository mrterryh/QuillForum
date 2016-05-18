<?php

namespace Quill\Forms;

class RegisterForm
{
    /**
     * The validation rules for the registration form.
     * 
     * @var array
     */
    public static $rules = [
        'username' => 'required',
        'email' => 'email|required',
        'password' => 'required',
        'password_conf' => 'required|same:password',
        'agree' => 'required'
    ];
}