<?php

namespace App\Http\Controllers\Api\Owners\V1\RealEstate;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Owners\RealEstates\StoreRequest;
use App\Http\Requests\Api\Owners\RealEstates\UpdateRequest;
use App\Http\Resources\Owners\RealEstates\RealEstateCollection;
use App\Http\Resources\Owners\RealEstates\RealEstateLargeResource;

class RealEstateController extends Controller
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
        ])->mine()->active()
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
    public function store(StoreRequest $request)
    {
        $request->add();

        return $this->successStatus(__('created successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $realEstate = RealEstate::mine()->whereId($id)->first();

        if (!$realEstate) return $this->errorStatus('not found ..!');

        return $this->respondWithItem(new RealEstateLargeResource($realEstate));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $request->edit($id);

        return $this->successStatus(__('created successfully'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePrice(Request $request)
    {
        foreach ($request->prices as $key => $price) {
            DB::table('realestate_price')->insert([
                'realestate_id' => $request->realestates_id,
                'day_id' => $request->days[$key],
                'price' => $price,
            ]);
        }
       
        RealEstate::whereId($request->realestates_id)->update([
            'price' => $request->prices[0]
        ]);

        return $this->successStatus(__('updated price successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(RealEstate $realEstate)
    {
        // if no one rent 

        $realEstate->delete();

        return $this->successStatus(__("Deleted"));
    }
}
