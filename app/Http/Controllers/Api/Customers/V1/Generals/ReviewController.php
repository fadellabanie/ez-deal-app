<?php

namespace App\Http\Controllers\Api\Customers\V1\Generals;

use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Customers\Reviews\StoreReviewRequest;
use App\Models\RealEstate;

class ReviewController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReviewRequest $request)
    {
        $request['customer_id'] = Auth::guard('customer')->id();

        Review::create($request->all());

        $review = Review::where('real_estate_id', $request->real_estate_id)->avg('rate');
        // dd($review);
        $rate = sprintf('%.2f', $review);

        RealEstate::whereId($request->real_estate_id)->update(['rate' => $rate]);

        return $this->successStatus();
    }
}
