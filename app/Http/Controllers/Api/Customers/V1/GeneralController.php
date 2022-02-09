<?php

namespace App\Http\Controllers\Api\Customers\V1;

use Illuminate\Http\Request;
use App\Models\Entertainment;
use App\Http\Controllers\Controller;
use App\Http\Resources\Customers\Entertainments\EntertainmentCollection;

class GeneralController extends Controller
{

    public function getEntertainmentByType(Request $request)
    {
        return new EntertainmentCollection(
            Entertainment::whereType($request->type)
                ->orderByDesc('id')
                ->paginate()
        );
    }
}
