<?php

namespace App\Http\Controllers\Api\Customers\v1\RealEstate;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customers\RealEstates\RealEstateCollection;
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


        $realEstates = RealEstate::NotReserved()
            ->active()

            ->when($request->filled('city_id'), function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })
            ->when($request->filled('realestate_type_id'), function ($q) use ($request) {
                $q->where('realestate_type_id', $request->realestate_type_id);
            })

            ->when($request->filled('guest_count'), function ($q) use ($request) {
                $q->where('guest_count', $request->guest_count);
            })
            ->when($request->filled('rate'), function ($q) use ($request) {
                $q->where('rate', $request->rate);
            })
            ->when($request->filled('attributes_ids'), function ($q) use ($request) {
                $q->whereRelation('attributes', function ($q) use ($request) {
                    $q->whereIn('attribute_id', $request->attributes_ids);
                });
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })->when($request->filled('price_from') || $request->filled('price_from'), function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })->when($request->filled('space_from') || $request->filled('space_to'), function ($q) use ($request) {
                $q->whereBetween('space', [$request->space_from, $request->space_to]);
            })
            ->orderBy($request->sorted_by, $request->sorted_type)->paginate();

        return new RealEstateCollection($realEstates);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $realEstate = RealEstate::whereId($id)->active()->first();

        if (!$realEstate)  return $this->respondNoContent();

        $realEstate->increment('number_of_views', 1);

        return $this->respondWithItem(new RealEstateLargeResource($realEstate));
    }
}
