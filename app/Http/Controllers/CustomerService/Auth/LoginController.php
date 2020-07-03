<?php

namespace App\Http\Controllers\CustomerService\Auth;

use App\Counter;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/cs';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:cs')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        try {
            $counter = Counter::where('ip', $request->ip())->firstOrFail();
        } catch (ModelNotFoundException $th) {
            return redirect()->route('cs.not_supported');
        }
        return view('auth.login', [
            'title' => 'Customer Service Login',
            'route' => 'cs.login',
        ]);
    }

    public function login(Request $request)
    {
        $this->validator($request);

        if (Auth::guard('cs')->attempt($request->only('username', 'password'), true)) {
            $counter = Counter::where('ip', $request->ip())->first();
            $counter->customer_service_id = Auth::guard('cs')->user()->id;
            $counter->save();

            return redirect()
                ->intended(route('cs.index'))
                ->with('status', 'You are Logged in as Customer Service!');
        }

        return $this->loginFailed();
    }

    public function logout()
    {
        if ($counter = Counter::where('customer_service_id', Auth::guard('cs')->user()->id)->first()) {
            $counter->customer_service_id = null;
            $counter->save();
        }

        Auth::guard('cs')->logout();
        return redirect()
            ->route('cs.login')
            ->with('status', 'Customer Service has been logged out!');
    }

    private function validator(Request $request)
    {
        //validation rules.
        $rules = [
            'username' => 'required|exists:customer_services|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'username.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules, $messages);
    }

    private function loginFailed()
    {
        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Login failed, please try again!');
    }
}
