<?php

namespace App\Http\Controllers\Api\Customers\V1\RealEstate;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customers\RealEstates\RealEstateCollection;
use App\Http\Resources\Customers\RealEstates\RealEstateTinyResource;
use App\Http\Resources\Customers\RealEstates\RealEstateLargeResource;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $realEstates = RealEstate::active()->NotReserved()
            ->when($request->filled('city_id'), function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->filled('realestate_type_id'), function ($q) use ($request) {
                $q->where('realestate_type_id', $request->realestate_type_id);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($q) use ($request) {
                    $q->where('ar_name', 'like', '%' . $request->search . '%');
                    $q->orWhere('en_name', 'like', '%' . $request->search . '%');
                });
            })->when($request->filled('price_from') || $request->filled('price_from'), function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })->when($request->filled('space_from') || $request->filled('space_to'), function ($q) use ($request) {
                $q->whereBetween('space', [$request->space_from, $request->space_to]);
            })
            ->orderByDesc('id')->paginate();

        return new RealEstateCollection($realEstates);
    }
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayOnMap(Request $request)
    {

        $realEstates = RealEstate::active()->NotReserved()
            ->when($request->filled('city_id'), function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->filled('realestate_type_id'), function ($q) use ($request) {
                $q->where('realestate_type_id', $request->realestate_type_id);
            })
            ->orderByDesc('id')->paginate();

        return  RealEstateTinyResource::Collection($realEstates);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $realEstate = RealEstate::whereId($id)->active()->NotReserved()->first();

        if (!$realEstate)  return $this->errorNotFound();

        $realEstate->increment('number_of_views', 1);

        return $this->respondWithItem(new RealEstateLargeResource($realEstate));
    }
}
