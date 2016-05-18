<?php

namespace Quill\Http\Controllers;

use Quill\Forms\RegisterForm;
use Quill\Contracts\Repositories\UserRepositoryContract as UserRepo;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * @var UserRepo
     */
    protected $users;

    /**
     * Class constructor.
     * 
     * @param UserRepo $users
     */
    public function __construct(UserRepo $users)
    {
        $this->users = $users;
    }

    /**
     * Displays the login form to the user.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Attempts to authenticate the user.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLogin(Request $request)
    {
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        $authAttempt = Auth::attempt($credentials, $request->remember);

        if (! $authAttempt) {
            return redirect()->back()->withErrors([
                'username' => 'The credentials you provided are invalid.'
            ]);
        }

        return redirect()->to('/')->withSuccess(
            'You have been successfully signed in. Welcome back!'
        );
    }

    /**
     * Displays the login form to the user.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }


    /**
     * Creates the user and logs them in.
     * 
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $this->validate($request, RegisterForm::$rules);

        $data = $request->only(['email', 'username', 'password']);
        $user = $this->users->register($data);

        Auth::login($user);

        return redirect()->to('/')->withSuccess(
            'Your account has successfully been created. Please check your 
            inbox and click the activation link'
        );
    }

    /**
     * Logs the user out and redirects back.
     * 
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return redirect()->back()->withSuccess('Hope to see you again soon!');
    }
}