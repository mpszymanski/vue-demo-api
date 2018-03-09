<?php

namespace App\Http\Controllers;

use App\Events\ReceiptWasConfirmed;
use App\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $confirmed_number = Receipt::whereStatus(1)->count();
        $unconfirmed_number = Receipt::whereStatus(0)->count();

        $receipts = Receipt::with('customer')
            ->orderBy('status', 'asc')
            ->paginate(10);

        return view('home', 
            compact('receipts', 'confirmed_number', 'unconfirmed_number'));
    }

    /**
     * Update receipt status
     * 
     * @param  Receipt $receipt 
     * @return \Illuminate\Http\Response   
     */
    public function status(Receipt $receipt)
    {
event(new ReceiptWasConfirmed($receipt));
        
        try {
            $status = (int) request()->get('status');
            $receipt->update(compact('status'));

            if($status)
                event(new ReceiptWasConfirmed($receipt));

            return redirect()
                ->back()
                ->with('message', 'Receipt was updated!');

        } catch(\Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->back()
                ->with('message', 'Opss! Something went wrong!');
        }
    }

    public function destroy(Receipt $receipt)
    {
        $receipt->delete();

        return redirect()
                ->back()
                ->with('message', 'Receipt was deleted!');
    }
}
