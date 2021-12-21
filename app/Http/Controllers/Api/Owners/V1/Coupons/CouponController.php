<?php

namespace App\Http\Controllers\Api\Owners\V1\Coupons;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owners\Coupons\CouponCollection;
use App\Http\Requests\Api\Owners\Coupons\StoreCouponRequest;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $coupons =  Coupon::mine()->orderByDesc('id')->paginate(Coupon::PAGINATE);

        return new CouponCollection($coupons);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCouponRequest $request)
    {
        $request->add();

        return $this->successStatus(__('created successfully'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon =  Coupon::mine()->whereId($id)->first();

        $coupon->update(['status' => !$coupon->status]);

        $coupons =  Coupon::mine()->orderByDesc('id')->paginate(Coupon::PAGINATE);

        return new CouponCollection($coupons);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Coupon::mine()->whereId($id)->delete();

        return $this->successStatus(__("Deleted"));
    }
}
