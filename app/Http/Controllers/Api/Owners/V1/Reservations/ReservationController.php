<?php

namespace App\Http\Controllers\Api\Owners\V1\Reservations;

use App\Models\RealEstate;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Owners\RealEstates\RealEstateCollection;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $realEstates = RealEstate::with([
            'city', 'country', 'realestateType', 'medias', 'attributes', 'prices'
        ])->mine()->active()->reserved()
            ->where(function ($q) use ($request) {
                $q->where('ar_name', 'like', '%' . $request->search . '%');
                $q->orWhere('en_name', 'like', '%' . $request->search . '%');
            })
            ->orderByDesc('id')->paginate(RealEstate::PAGINATE);

        return new RealEstateCollection($realEstates);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Reservations::create([
            'realestate_id' => $request->realestate_id,
            'from' => $request->from,
            'to' => $request->to,
            'status' => 'reserve',
        ]);

        RealEstate::whereId($request->realestate_id)->update([
            'is_reserved' => true
        ]);

        return $this->successStatus(__('reservations successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation =  Reservations::find($id);

        if (!$reservation) return $this->errorStatus('not found');

        RealEstate::whereId($reservation->realestate_id)->update([
            'is_reserved' => false
        ]);

        $reservation->delete();

        return $this->successStatus(__("Deleted"));
    }
}
