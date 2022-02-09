<?php

namespace App\Http\Controllers\Api\Customers\V1\Booking;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\RealEstate;
use App\Models\Reservations;

class BookingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chackCopone(Request $request)
    {
        $realEstate  = RealEstate::whereId($request->real_estate_id)->select('owner_id')->first();
        $coupon = Coupon::where('owner_id', $realEstate->owner_id)->where('code', $request->code)->first();

        if (!$coupon) return $this->errorStatus('coupon not curract');

        return $this->successStatus('coupon is vaild');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function book(Request $request)
    {
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->to);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->from);
        $diff_in_days = $to->diffInDays($from);

        Reservations::create([
            'realestate_id' => $request->real_estate_id,
            'from' => $request->from,
            'to' => $request->to,
            'diff_in_days' => $diff_in_days,
            'status' => Reservations::Witing_Reserve
        ]);

        // send email for customer 
        // send owner notification 
        // run command for 

        return $this->successStatus();
    }
}
