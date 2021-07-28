<?php

namespace App\Http\Controllers;

use App\VerifyCode;
use App\Walletaddress;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Throwable;
use PHPMailer\PHPMailer\PHPMailer;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the value...
        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        $data = $request->all();

        $check = $this->create($data);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }
        return redirect('/sign-up');

    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return redirect('login')->with('errors', 'Oppes! You have entered invalid credentials');
    }

    public function signup()
    {
        //
        return view('auth.signup');
    }
    public function signin()
    {
        //
        return view('auth.signin');
    }
    public function resetpassword()
    {
        //
        return view('auth.resetpassword');
    }
    public function editprofile()
    {

        return view('auth.editprofile');
    }

    public function posteditprofile(Request $request)
    {

        if($request->email == Auth::user()->email) {
            $user = User::find(Auth::user()->id);
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->country = $request->country;
            $user->wallet_address = $request->wallet_address;
            $user->save();
            return redirect('editprofile')->with('success', 'Your Profile successfully saved.');
        }

        request()->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'wallet_address' => 'required',
            'email' => 'required|email|unique:users',
        ]);
        $user = User::find(Auth::user()->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->country = $request->country;
        $user->email = $request->email;
        $user->wallet_address = $request->wallet_address;
        $user->save();
        return redirect('editprofile');
    }

    public function posteditwallet(Request $request) {
        Walletaddress::where('user_id','=', Auth::id())->delete();
        $types = $request->type;
        $addresses = $request->address;

        for($i = 1; $i < count($types); $i++) {
            $temp = new Walletaddress();
            $temp->user_id = Auth::id();
            $temp->type = $types[$i];
            $temp->wallet_address = $addresses[$i];
            $temp->save();
        }
        return redirect('/transactions')->with('success', 'Your Wallet address successfully saved.');
    }

    public function postresetpassword(Request $request)
    {
        $user = User::where('email', $request->resetemail) -> first();
        if ($user) {
            $result = $this->generateRandomString(6);
            $verifycode = VerifyCode::where('email', '=', $request->resetemail)->first();
            if($verifycode) {
                $verifycode->code = $result;
                $verifycode->save();
            } else {
                $temp = new VerifyCode();
                $temp->email = $request->resetemail;
                $temp->code = $result;
                $temp->save();
            }
            mail($request->resetemail, "Door2coin.com account reset password validation", "To reset the password of Door2coin.com account, please use this verification code - ".$result);
            return redirect('/reset-verify')->with('error', $result);
        } else {
            return redirect('/reset-password')->with('errors', 'Your email is invalid.');
        }
    }
    public function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function resetverify()
    {
        return view('auth.resetverify');
    }
    public function postresetverify(Request $request)
    {
        $request->validate([
            'resetemail' => 'required|string|email',
            'verifycode' => 'required|string'
        ]);
        $verifycode = VerifyCode::where('email', '=', $request->resetemail)->first();
        $result = $verifycode->code;
        if($request->verifycode != $result) {
            return redirect('/reset-verify')->with('errors', 'Your Verification code is invalid.');
        }
        return redirect('/newpassword');
    }
    public function changepassword()
    {
        return view('auth.changepassword');
    }
    public function newpassword()
    {
        return view('auth.newpassword');
    }
    public function postnewpassword(Request $request)
    {
        $request->validate([
            'resetemail' => 'required|string|email',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);
        $user = User::where('email', $request->resetemail) -> first();
        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return redirect('/login');
    }

    public function postchangepassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        request()->validate([
            'oldpassword' => 'required|min:6',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
        ]);

        if($request->password != $request->password_confirmation) {
            return redirect('changepassword')->with('error', 'New password isn\'t match.');
        }
        if (Hash::check($request->oldpassword, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            return redirect('changepassword')->with('success', 'Your password successfully changed.');
        } else {
            return redirect('changepassword')->with('error', 'Your password is invalid.');
        }

    }

    public function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'country' => $data['country'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function logout() {
        Session::flush();
        Auth::logout();

        return redirect('/login');
    }
    public function delete() {
        $user = User::find(Auth::user()->id);

        Session::flush();
        Auth::logout();

        $user->delete();

        return redirect('/login');
    }

    public function sendresetemail(int $result, string $resetemail) {
        $mail = new PHPMailer(true); // notice the \  you have to use root namespace here
        try {
            $mail->isSMTP(); // tell to use smtp
            $mail->CharSet = "utf-8"; // set charset to utf8
            $mail->SMTPAuth = true;  // use smpt auth
            $mail->SMTPSecure = "tls"; // or ssl
            $mail->Host = "yourmailhost";
            $mail->Port = 2525; // most likely something different for you. This is the mailtrap.io port i use for testing.
            $mail->Username = "username";
            $mail->Password = "password";
            $mail->setFrom("youremail@yourdomain.de", "Firstname Lastname");
            $mail->Subject = "Test";
            $mail->MsgHTML("This is a test");
            $mail->addAddress("recipient@anotherdomain.de", "Recipient Name");
            $mail->send();
        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }
        die('success');
    }


    public function amlkycpolicy() {
        return view('auth.amlkycpolicy');
    }
    public function termsofservice() {
        return view('auth.termsofservice');
    }
    public function privacynotice() {
        return view('auth.privacynotice');
    }
}
