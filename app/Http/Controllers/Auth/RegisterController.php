<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Validator;
use gateweb\common\Presenter;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'email.unique' => 'Το email χρησιμοποιείται. Εάν έχετε εγγραφεί ήδη, δοκιμάστε να συνδεθείτε.', 
        ];        
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'attribute' => 'required',
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        /**
         * sent inform mail to me
         */
        $inform = $data; unset($inform['password']); unset($inform['password_confirmation']); unset($inform['_token']);
        Presenter::mail(Presenter::dd($inform),'registered user in conference');

        Presenter::message( __('Συνδεθήκατε με επιτυχία! Μπορείτε να δηλώσετε τα εργαστήρια που επιθυμείτε να παρακολουθήσετε. Δείτε τις σχετικές <a href="/page/faq#register">οδηγίες</a>.'),'success');
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role_id' => config('quickadmin.default_role_id'),
            'phone' => (new \gateweb\common\Router())->sanitize($data['phone'],'decimal'),
            'attribute' => $data['attribute']
        ]);
    }
}
