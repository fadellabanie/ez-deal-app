<?php

namespace App\Http\Controllers\Api\Customers\V1\Generals;

use App\Models\BankCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BankCardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cards = BankCard::mine()->get();

        return $this->respondWithCollection($cards);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['customer_id'] = Auth::guard('customer')->id();
        BankCard::create($request->all());

        return $this->successStatus();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        BankCard::mine()->whereId($id)->delete();

        return $this->successStatus(__("Deleted"));
    }
}
