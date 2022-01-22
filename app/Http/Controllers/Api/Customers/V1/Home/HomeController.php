<?php

namespace App\Http\Controllers\Api\Customers\V1\Home;

use App\Models\City;
use App\Models\AppBanner;
use App\Models\AppSetting;
use App\Models\RealEstate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Constants\CityResource;
use App\Http\Resources\Constants\AppSettingResource;
use App\Http\Resources\Constants\HomeBannerResource;
use App\Http\Resources\Customers\RealEstates\RealEstateCollection;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {

        if (auth('api')->check()) {
            $city_id =  auth('api')->user()->city_id;
        } else {
            $city_id = 1;
        }
        #####################################

        $homeBanners = AppBanner::mobile()->MyStory($city_id)
            ->bottom()
            ->WhereDate('end_date', '>=', now())->active()->get();
        $data['home_banners'] = HomeBannerResource::collection($homeBanners);

        #####################################

        $cities = City::active()->get();
        $data['cities'] = CityResource::collection($cities);

        #####################################


        $appSetting = AppSetting::get();
        $data['app_setting'] = AppSettingResource::collection($appSetting);

        return $this->respondWithCollection($data);
    }



    public function search(Request $request)
    {
        $realEstates = RealEstate::NotReserved()->active()
            ->when($request->filled('city_id'), function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            })->when($request->filled('realestate_type_id'), function ($q) use ($request) {
                $q->where('realestate_type_id', $request->realestate_type_id);
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->filled('price_from') || $request->filled('price_from'), function ($q) use ($request) {
                $q->whereBetween('price', [$request->price_from, $request->price_to]);
            })->when($request->filled('space_from') || $request->filled('space_to'), function ($q) use ($request) {
                $q->whereBetween('space', [$request->space_from, $request->space_to]);
            })
            ->orderBy('type', 'DESC')->paginate();

        return new RealEstateCollection($realEstates);
    }


    public function pay(Request $request)
    {
        $response = $this->pay($request);

        if ($response['status'] == 2) {
            return $this->errorStatus($response['errorText'] . '-' . $response['error'] . '-' . $response['status']);
        } else {
            //dd($response['PaymentID']);
            return $this->respondWithItemName('url', "https://securepayments.alrajhibank.com.sa/pg/paymentpage.htm?PaymentID=" . $response['PaymentID']);
        }
        //  return $this->successStatus($response);
    }
    public function success(Request $request)
    {
        $bodyContent = $request->json();
        $content =  json_encode($bodyContent);
        dd($bodyContent);
    }
}
