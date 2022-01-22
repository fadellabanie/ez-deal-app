<?php

namespace App\Http\Controllers\Api\Customers\V1\Generals;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::mine()->get();

        return $this->respondWithCollection($address);
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
        Address::create($request->all());

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

        Address::mine()->whereId($id)->delete();

        return $this->successStatus(__("Deleted"));
    }
}
