<?php

namespace App\Http\Controllers\V1;

use App\Helpers\Exchange;
use App\Http\Resources\V1\TripsIndexResource;
use App\Http\Resources\V1\TripsShowResource;
use App\Models\Trips;
use App\Http\Requests\V1\StoreTripsRequest;
use App\Http\Requests\V1\UpdateTripsRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TripsController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */

    public function index(Request $request)
    {
        $trips = Trips::query();

        if(request()->input('title')) {
            $trips = $trips->orWhere('title','LIKE','%'.request()->input('title').'%');
        }

        if(request()->input('orderBy')) {
            switch (request()->input('orderBy')) {
                case 'dateDesc':
                    $trips = $trips->orderBy('updated_at','DESC');
                    break;
                case 'dateAsc':
                    $trips = $trips->orderBy('updated_at','ASC');
                    break;
                case 'dateFromAsc':
                    $trips = $trips->orderBy('date_from','ASC');
                    break;
                case 'dateFromdesc':
                    $trips = $trips->orderBy('date_from','DESC');
                    break;
                case 'dateToAsc':
                    $trips = $trips->orderBy('date_to','ASC');
                    break;
                case 'dateToDesc':
                    $trips = $trips->orderBy('date_to','DESC');
                    break;
                default:
                    $trips = $trips->orderByDesc('created_at');
            }

        }

        if(\request()->input('priceFrom') || \request()->input('priceTo')) {
            $priceFrom = \request()->input('priceFrom');
            $priceTo = \request()->input('priceTo');

            if ($priceFrom < $priceTo) {
                $trips = $trips->orWhereBetween('price', [$priceFrom, $priceTo]);
            }
        }

        $trips = $trips->paginate(10);
        return TripsIndexResource::collection($trips);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param StoreTripsRequest $request
     * @return JsonResponse
     */
    public function store(StoreTripsRequest $request)
    {
        return response()->json(Trips::create($request->all()))->setStatusCode(300);
    }

    /**
     * @param $request
     * @return AnonymousResourceCollection
     */
    public function show($request)
    {
        $fetchTrip = Trips::query()
            ->orWhere('slug',$request)
            ->orWhere('id',$request)
            ->get();

        return TripsShowResource::collection($fetchTrip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTripsRequest $request
     * @return JsonResponse
     */
    public function update(UpdateTripsRequest $request, Trips $trip)
    {
        $trip->update($request->all());
        return response()->json($trip)->setStatusCode(300);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Trips $trip
     * @return JsonResponse
     */
    public function destroy(Trips $trip)
    {
        $trip->delete();
        return response()->json($trip)->setStatusCode(300);
    }
}
