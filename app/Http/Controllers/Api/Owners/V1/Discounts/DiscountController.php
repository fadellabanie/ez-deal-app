<?php

namespace App\Http\Controllers\Api\Owners\V1\Discounts;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Owners\Discounts\DiscountCollection;
use App\Http\Requests\Api\Owners\Discounts\StoreDiscountRequest;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts =  Discount::mine()
        ->orderByDesc('id')->paginate(Discount::PAGINATE);

        return new DiscountCollection($discounts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiscountRequest $request)
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
        $discount =  Discount::mine()->whereId($id)->first();

        $discount->update(['status' => !$discount->status]);

        $discounts =  Discount::mine()->orderByDesc('id')->paginate(Discount::PAGINATE);

        return new DiscountCollection($discounts);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Discount::mine()->whereId($id)->delete();

        return $this->successStatus(__("Deleted"));
    }
}
