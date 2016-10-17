<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    use ResetsPasswords, ThrottlesLogins;

    protected $username;
    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Validate the request of sending reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function sendResetLinkEmail(Request $request)
    {
        $this->incrementLoginAttempts($request);
        $this->username = 'email';
        Log::debug("Validate");

        if($this->hasTooManyLoginAttempts($request)) {
            return redirect()->back()->withErrors(['email' => "You have exceeded the limit of attempts. Please try again shortly"]);
        }

        $this->validate($request, ['email' => 'required|email']);

        $broker = $this->getBroker();

        $response = Password::broker($broker)->sendResetLink(
            $request->only('email'), $this->resetEmailBuilder()
        );

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->getSendResetLinkEmailSuccessResponse($response);

            case Password::INVALID_USER:
            default:
                return $this->getSendResetLinkEmailFailureResponse($response);
        }

    }

    public function loginUsername()
    {
        return property_exists($this, 'username') ? $this->username : 'email';
    }

    protected function getThrottleKey(Request $request)
    {
        return $request->ip();
    }
}