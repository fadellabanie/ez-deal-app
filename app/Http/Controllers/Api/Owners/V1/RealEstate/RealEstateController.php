<?php

namespace App\Http\Controllers\Api\Owners\V1\RealEstate;

use App\Models\RealEstate;
use Illuminate\Http\Request;
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
        $realEstates = RealEstate::mine()->active()
            ->where('ar_name', 'like', '%' . $request->search . '%')
            ->orWhere('en_name', 'like', '%' . $request->search . '%')
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
        $realEstate = RealEstate::mine()->whereId($id)->active()->first();

        if (!$realEstate)  return $this->respondNoContent();

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
