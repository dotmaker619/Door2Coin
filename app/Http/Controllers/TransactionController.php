<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Walletaddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Datatables;

class TransactionController extends Controller
{
    //
    public function index()
    {
        //
        $addresses = Walletaddress::where('user_id', '=', Auth::id())->get();
        return view('transaction.index', compact('addresses'));
    }

    public function datatables() {
        $datas = Transaction::where('user_id', '=', Auth::id())->where('status', '!=', 0)->take(100)->get();

        return Datatables::of($datas)
            ->addColumn('transaction_status', function(Transaction $data) {
                switch ($data->status) {
                    case 0:
                        return '<span class="data-request">Pending</span>';
                        break;
                    case 1:
                        return '<span class="data-success">Success</span>';
                        break;
                    case 2:
                        return '<span class="data-failed">Failed</span>';
                        break;
                }
            })->addColumn('created', function(Transaction $data) {
                return '<span class="data-request">'.date('Y-m-d H:i', strtotime($data->created_at)).'</span>';
            })
            ->rawColumns(['transaction_status', 'created'])->toJson();
    }
}
