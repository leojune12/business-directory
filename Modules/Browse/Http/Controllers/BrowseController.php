<?php

namespace Modules\Browse\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Address\Entities\Barangay;
use Modules\Address\Entities\City;
use Modules\Businesses\Entities\Business;

class BrowseController extends Controller
{
    public $module = 'Browse';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        return view('browse::index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = Business::whereNull('deleted_at');

        // Eager Loading
        $query->with('user:id,first_name,last_name', 'category', 'province', 'city', 'barangay');

        $this->queryHandler($query, $request);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        // if ($request->name != 'null' && $request->address != 'null') {

        //     $city_ids = City::where('citymunDesc', 'like', $request->address . '%')->pluck('citymunCode');

        //     $barangay_ids = Barangay::where('brgyDesc', 'like', $request->address . '%')->pluck('brgyCode');

        //     return $query
        //         ->where(function($query) use($request, $barangay_ids) {
        //             $query->where('name', 'like', '%' . $request->name . '%')
        //                   ->whereIn('barangay_id', $barangay_ids);
        //         })
        //         ->orWhere(function($query) use($request, $city_ids) {
        //             $query->where('name', 'like', '%' . $request->name . '%')
        //                   ->whereIn('city_id', $city_ids);
        //         });;
        // } else if ($request->name != 'null') {

        //     $query->when($request->name != 'null', function ($query) use ($request) {
        //         return $query->where('name', 'like', $request->name . '%');
        //     });
        // } else {

        //     $query->when($request->address != 'null', function ($query) use ($request) {

        //         $city_ids = City::where('citymunDesc', 'like', $request->address . '%')->pluck('citymunCode');

        //         $barangay_ids = Barangay::where('brgyDesc', 'like', $request->address . '%')->pluck('brgyCode');

        //         return $query
        //             ->whereIn('barangay_id', $barangay_ids)
        //             ->orwhereIn('city_id', $city_ids);
        //     });
        // }

        $query->when($request->name != 'null', function ($query) use ($request) {
            return $query->where('name', 'like', $request->name . '%');
        });

        $query->when($request->address != 'null', function ($query) use ($request) {
            return $query->where('full_address', 'like', '%' .$request->address . '%');
        });

        return $query;
    }
}
