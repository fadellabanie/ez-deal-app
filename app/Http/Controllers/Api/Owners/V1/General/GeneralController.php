<?php

namespace App\Http\Controllers\Api\Owners\V1\General;

use App\Models\Video;
use App\Models\RealEstate;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Constants\VideoResource;
use App\Http\Requests\Api\Owners\General\UpdateProfileRequest;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
       // dd(Auth::guard('owner')->id());
        return now();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function video()
    {
        $videos = Video::orderByDesc('id')->paginate();

        return $this->respondWithCollection(new VideoResource($videos));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(UpdateProfileRequest $request)
    {
        $request->edit(Auth::guard('owner')->id());

        return $this->successStatus(__('update successfully'));
    }
    
}
