<?php

namespace App\Http\Controllers\Api\Customers\V1\Favorites;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Customers\Favorites\FavoriteRequest;
use App\Http\Resources\Customers\Favorites\FavoriteCollection;

class FavoriteController extends Controller
{

    public function index()
    {
        $favorites =  Favorite::with('realEstate')->mine()->get();

        return new FavoriteCollection($favorites);
    }

    public function store(FavoriteRequest $request)
    {
        $favorite = Favorite::where([
            'real_estate_id' => $request->real_estate_id,
            'customer_id' => Auth::guard('customer')->id(),
        ])->first();
        if ($favorite) {
            $favorite->delete();
            return $this->successStatus(__("Unfavorite success"));
        }
        Favorite::create([
            'real_estate_id' => $request->real_estate_id,
            'customer_id' => Auth::guard('customer')->id(),
        ]);

        return $this->successStatus(__("Add to favorite success"));
    }
}
