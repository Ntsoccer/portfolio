<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Mail\EmailVerification;
use App\Forms\UserForm;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;


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
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      $user = User::create([
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'email_verify_token' => base64_encode($data['email']),
      ]);

      $email = new EmailVerification($user);
      Mail::to($user->email) ->send($email);

      return $user;
    }

    public function register(Request $request)
    {
        event(new Registered($user = $this->create( $request->all() )));

        return view('auth.registered');
    }

    public function redirectPath()
    {
        return 'users';
    }

    public function pre_check(Request $request){

      $this->validator($request->all())->validate();

      $bridge_request = $request->all();
      // password マスキング
      $bridge_request['password_mask'] = '******';

      return view('auth.register_check')->with($bridge_request);
  }

  public function  showForm(FormBuilder $formBuilder,$email_token)
    {

        $form = $formBuilder->create(UserForm::class);

        if ( !User::where('email_verify_token', $email_token)->exists()){

            return view('auth.main_register', compact('form'))->with('message', '無効なトークンです。');

        } else {

            $user = User::where('email_verify_token', $email_token)->first();

            if ($user->status == config('const.USER_STATUS.REGISTER')) {
                return view('auth.main_register', compact('form'))->with('message', 'すでに本登録されています。ログインして利用してください。');
            }

            $user->status = config('const.USER_STATUS.MAIL_AUTHED');
            $user->email_verified_at = Carbon::now();

            if ($user->save()) {
                return view('auth.main_register', compact('email_token','form'));
            } else {
                return view('auth.main_register', compact('form'))->with('message', 'メール認証に失敗しました。再度、メールからリンクをクリックしてください。');
            }

        }
    }

    public function mainCheck(FormBuilder $formBuilder,$email_token)
    {
        $form = $formBuilder->create(UserForm::class);

        if (!$form->isValid()) {
            return redirect()->back()->withErrors($form->getErrors())->withInput();
        }

        $user = $form->check();


        return view('auth.main_register_check', compact('user' , 'form', 'email_token'));
    }



    public function mainRegister(Request $request, $email_token)
    {
        $user = User::where('email_verify_token', $email_token)->first();
        
        $user->name = $request->name;
        // $user->phone_number = $request->phone_number;
        // $user->birthday = $request->birthday;
        // $user->address = $request->address;
        $user->save();

        return view('auth.main_registered');
    }
}