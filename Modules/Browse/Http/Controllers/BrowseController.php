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
        if ($request->name != 'null' && $request->address != 'null') {

            $city_ids = City::where('citymunDesc', 'like', $request->address . '%')->pluck('citymunCode');

            $barangay_ids = Barangay::where('brgyDesc', 'like', $request->address . '%')->pluck('brgyCode');

            return $query
                ->where(function($query) use($request, $barangay_ids) {
                    $query->where('name', 'like', '%' . $request->name . '%')
                          ->whereIn('barangay_id', $barangay_ids);
                })
                ->orWhere(function($query) use($request, $city_ids) {
                    $query->where('name', 'like', '%' . $request->name . '%')
                          ->whereIn('city_id', $city_ids);
                });;
        } else if ($request->name != 'null') {

            $query->when($request->name != 'null', function ($query) use ($request) {
                return $query->where('name', 'like', $request->name . '%');
            });
        } else {

            $query->when($request->address != 'null', function ($query) use ($request) {

                $city_ids = City::where('citymunDesc', 'like', $request->address . '%')->pluck('citymunCode');

                $barangay_ids = Barangay::where('brgyDesc', 'like', $request->address . '%')->pluck('brgyCode');

                return $query
                    ->whereIn('barangay_id', $barangay_ids)
                    ->orwhereIn('city_id', $city_ids);
            });
        }

        return $query;
    }

    public function create()
    {
        return view('browse::form', [
            'module' => $this->module,
            'method' => 'Create',
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Whoops!',
                'message' => 'Please complete the form.',
                'errors' => $validator->errors(),
                'old' => $request->all(),
            ]);
        }

        DB::beginTransaction();

        try {

            $model = Browse::create($request->only([
                'name'
            ]));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Item successfully created.'
            ]);
        } catch (Throwable $e) {

            // return $e;
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'title' => 'Something went wrong!',
                'message' => 'Please try again.'
            ]);
        }
    }

    public function show($id)
    {
        $model = Browse::findOrFail($id);

        return view('browse::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Browse::findOrFail($id);

        return view('browse::form', [
            'module' => $this->module,
            'method' => 'Update',
            'model' => $model,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Browse::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'title' => 'Whoops!',
                'message' => 'Please complete the form.',
                'errors' => $validator->errors(),
                'old' => $request->all(),
            ]);
        }

        DB::beginTransaction();

        try {

            $model->update($request->only([
                'name'
            ]));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'title' => 'Success!',
                'message' => 'Item successfully updated.'
            ]);
        } catch (Throwable $e) {

            return $e;
            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'title' => 'Something went wrong!',
                'message' => 'Please try again.'
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();

        try {

            Browse::destroy($request->id_array);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Item deleted successfully.'
            ]);
        } catch (Throwable $e) {

            DB::rollBack();

            return response()->json([
                'status' => 'error',
                'message' => 'Whoops! Something went wrong. Please try again.'
            ]);
        }
    }
}
