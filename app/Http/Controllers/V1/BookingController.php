<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\BookingIndexResource;
use App\Http\Resources\V1\BookingShowResource;
use App\Models\Bookings;
use App\Models\Trips;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = \auth()->user()->bookings;
        if ($bookings) {
            return BookingIndexResource::collection($bookings);
        }

        return response(['data' => 'No bookings found'])->json()->setStatusCode(200);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * Should write a custom validator
     * that checks if trip actually
     * exists
     */
    public function reserve(Request $request)
    {
        $user_id = \auth()->user()->id;
        $input = $request->validate(['trip_id' => 'int | min:1']);
        $trip = Trips::all(['id'])->where('id',$input['trip_id'])->firstOrFail();
        if($trip) {
            if ($trip->user && $trip->user->id) {
                return response()->json(['data' => 'Trip with id: '.$input['trip_id'].' is already booked by someone'])->setStatusCode(211);
            }
            $create = Bookings::create(['user_id' => $user_id, 'trip_id' => $input['trip_id']]);
            return response()->json($create)->setStatusCode(200);
        } else {
            return response()->json(['data' => 'Could not find specified trip'])->setStatusCode(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Bookings $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Bookings $booking)
    {
        return new BookingShowResource($booking);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bookings $bookings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookings $bookings)
    {
        //nothing to really update
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Bookings $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookings $booking)
    {
        return $booking->delete();
    }
}
