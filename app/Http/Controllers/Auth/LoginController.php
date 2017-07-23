<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Companies;
use Auth;
use View;
use JavaScript;
use LaravelLocalization;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/companyselect';

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm(Request $request)
    {
        //Get the company slug
        $slug = $request->company;
        if ($slug !== 'www') {
            return redirect()->route('login', ['domain' => 'www']);
        }

        return view('auth.login');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest', ['except' => 'logout']);
        JavaScript::put([
            'locale'     => LaravelLocalization::getCurrentLocale(),
        ]);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);

        return redirect()->route('front.index', ['domain' => 'www'])->with('status', 'Profile updated!');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        $field = filter_var($this->request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->request->merge([$field => $this->request->input('login')]);

        return $field;
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->credentials($request);

        // This section is the only change
        if (Auth::validate($credentials)) {
            $user = Auth::getLastAttempted();
            if ($user->is_verified) {
                Auth::login($user, $request->has('remember'));
                return $this->sendLoginResponse($request);
            }
            else {
                return response()->json(array(
                    'code'      =>  500,
                    'email'   =>  'Your email is not verified. Please verify your email by clicking on link in email verification mail.'
                ), 500);
            }
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $companies = Auth::user()->companies()->where('settings->is_invitation_accepted', 1)->get();

        $view = View::make('modals.select_company', ['companies' => $companies]);
        $contents = $view->render();

        return $contents;
    }
}
