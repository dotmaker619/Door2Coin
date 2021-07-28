<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\User;
use App\Walletaddress;
use authDTO;
use Carbon\Carbon;
use Exception;
use findPaymentByOrderId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MerchantWebService;
use paymentOrderRequest;

class DashboardController extends Controller
{
    public function getRate() {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.coingecko.com/api/v3/coins/bitcoin/tickers',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $commission = 1.1;

        $response_pair_info = json_decode(curl_exec($curl), true);

        curl_close($curl);

        return 10000;

        foreach($response_pair_info["tickers"] as $pair) {
            if($pair['target'] == 'EUR'){
                return floatval($pair['last']) * $commission;
            }
        }

        return 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $rate = $this->getRate();

        if(Auth::check()){
            $wallets = Walletaddress::where('user_id', '=', Auth::id())->get();
            $wallet_id = -1;
            if(isset($_GET['wallet_id'])){
                $wallet_id = $_GET['wallet_id'];
            }
            return view('buycoin.index', ['rate' => $rate, 'wallets' => $wallets, 'wallet_id' => $wallet_id]);
        }
        return view('buycoin.index', ['rate' => $rate]);
    }

    public function getTransactionId(Request $request){
        $transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->save();
        $transaction->order_id = 77877 + $transaction->id;
        $transaction->amount = $request->ac_amount;
        $transaction->currency_from = $request->ac_currency;
        $transaction->comment = $request->ac_comments;
        $transaction->status = 0;

        $commission = 1;
        $rate = $this->getRate() * $commission;

        $transaction->rate = round($rate, 2);
        // $transaction->crypto = round(($request->ac_amount) / $rate, 8);
        $transaction->crypto = sprintf("%.8f",($request->ac_amount) / $rate) ;
        $transaction->wallet_address = $request->wallet_address;

        $transaction->save();

        if($request->type != -1) {
            $wallet = Walletaddress::findorFail($request->type);
            $wallet->wallet_address = $request->wallet_address;
            $wallet->save();
        }

        return response()->json(['data' => $transaction]);
    }

    public function success($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 1;
        $transaction->save();

        $user = User::findOrFail($transaction->user_id);

        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Email:</strong> </td><td>" . $user->email . "</td></tr>";
        $message .= "<tr><td><strong>Wallet Address:</strong> </td><td>" . $transaction->wallet_address . "</td></tr>";
        $message .= "<tr><td><strong>Amount:</strong> </td><td>" . $_GET['ac_amount'] . "</td></tr>";
        $message .= "<tr><td><strong>Currency:</strong> </td><td>" . $_GET['ac_merchant_currency'] . "</td></tr>";
        $message .= "<tr><td><strong>Date:</strong> </td><td>" . Carbon::now()->format('Y-m-d'). "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        $headers = "From: door2coin@com \r\n";
        $headers .= "Reply-To: ". $user->email . "\r\n";
        $headers .= "CC: door2coin@coin.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail("alex@minersold.com", "Door2coin.com buy bitcoin", $message, $headers);
//        mail("polarbear91781014@gmail.com", "Door2coin.com buy bitcoin", $message, $headers);

        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('max_execution_time', 0);
        require_once("MerchantWebService.php");
        $merchantWebService = new MerchantWebService();

        $arg0 = new authDTO();
        $arg0->apiName = "Door2Coin.com";
        $arg0->accountEmail = "alex@minersold.com";
        $arg0->authenticationToken = $merchantWebService->getAuthenticationToken("m@l0y1dQ4s");

        $arg1 = new paymentOrderRequest();
        $arg1->sciName = "Door2Coin.com";
        $arg1->orderId = $transaction->order_id;

        $findPaymentByOrderId = new findPaymentByOrderId();
        $findPaymentByOrderId->arg0 = $arg0;
        $findPaymentByOrderId->arg1 = $arg1;

        try {
            $findPaymentByOrderIdResponse = $merchantWebService->findPaymentByOrderId($findPaymentByOrderId);
            $transaction->transaction_id = $findPaymentByOrderIdResponse->return->transactionId;
            $transaction->save();
        } catch (Exception $e) {
            echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
            echo $e->getTraceAsString();
        }

        return redirect('/transactions');
    }
    public function fail($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 2;
        $transaction->save();
        return redirect('/transactions');
    }
    public function status(){
        $id = $_GET['id'];
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 1;
        $transaction->save();
        return view('transaction.index');
    }
    public function buycoin(){
        return view('buycoin.buycoin');
    }
}
