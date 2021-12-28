<?php

namespace App\Http\Controllers\Api\Owners\V1\Reservations;

use App\Models\RealEstate;
use App\Models\Reservations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Owners\Reservations\StoreRequest;
use App\Http\Resources\Owners\RealEstates\RealEstateCollection;
use App\Http\Resources\Owners\Reservations\ReservationCollection;

class ReservationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $reservations = Reservations::with(['realestate' => function ($q) use ($request) {
            $q->mine()->active()->reserved()->where(function ($q) use ($request) {
                $q->where('ar_name', 'like', '%' . $request->search . '%');
                $q->orWhere('en_name', 'like', '%' . $request->search . '%');
            });
        }])
            ->reserve()
            ->orderByDesc('id')
            ->paginate(RealEstate::PAGINATE);

        return new ReservationCollection($reservations);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function active(Request $request)
    {
        $reservations = Reservations::with(['realestate' => function ($q) use ($request) {
            $q->mine()->active()->reserved()->where(function ($q) use ($request) {
                $q->where('ar_name', 'like', '%' . $request->search . '%');
                $q->orWhere('en_name', 'like', '%' . $request->search . '%');
            });
        }])
            ->where('from', '<=', now())
            ->where('to', '>=', now())
            ->orderByDesc('id')
            ->paginate(RealEstate::PAGINATE);

        return new ReservationCollection($reservations);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function finished(Request $request)
    {
        $reservations = Reservations::with(['realestate' => function ($q) use ($request) {
            $q->mine()->active()->reserved()->where(function ($q) use ($request) {
                $q->where('ar_name', 'like', '%' . $request->search . '%');
                $q->orWhere('en_name', 'like', '%' . $request->search . '%');
            });
        }])
            ->notReserved()
            
            ->orderByDesc('id')
            ->paginate(RealEstate::PAGINATE);

        return new ReservationCollection($reservations);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $reservation = Reservations::where('realestate_id', $request->realestate_id)
            ->whereBetween('from', [$request->from, $request->to])
            ->orWhereBetween('to', [$request->from, $request->to])
            ->orWhere(fn ($q) =>
            $q->where('from', '<', $request->from)
                ->where('to', '>', $request->to))
            ->exists();

        if (!$reservation) {
            return $this->errorStatus('date not available');
        }
        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->to);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->from);
        $diff_in_days = $to->diffInDays($from);

        Reservations::create([
            'realestate_id' => $request->realestate_id,
            'from' => $request->from,
            'to' => $request->to,
            'diff_in_days' => $diff_in_days,
            'status' => Reservations::Reserve,
        ]);

        return $this->successStatus(__('reservations successfully'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Reservations::whereId($id)->update([
            'from' => $request->from,
            'to' => $request->to,
        ]);

        return $this->successStatus(__('created successfully'));
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
