<?php

namespace Modules\Businesses\Http\Controllers;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\City;
use Illuminate\Support\Facades\Validator;
use Modules\Businesses\Entities\Business;
use Modules\Categories\Entities\Category;
use Illuminate\Contracts\Support\Renderable;
use Modules\Categories\Entities\BusinessCategory;
use Modules\Subcategory\Entities\BusinessSubcategory;

class BusinessesController extends Controller
{
    public $module = 'Business';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        return view('businesses::index', [
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
        $query->when($request->name != 'null', function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->name . '%');
        });

        $query->when($request->address != 'null', function ($query) use ($request) {
            return $query->where('address', 'like', '%' . $request->address . '%');
        });

        // $query->when($request->contact_number != 'null', function ($query) use ($request) {
        //     return $query->where('contact_number', 'like', '%' . $request->contact_number . '%');
        // });

        // $query->when($request->role != 'null', function ($query) use ($request) {
        //     return $query->role($request->role);
        // });

        return $query;
    }

    public function create()
    {
        return view('businesses::form', [
            'module' => $this->module,
            'method' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $model = Business::findOrFail($id)->load('category', 'subcategories', 'region', 'province', 'city', 'barangay');

        return view('businesses::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Business::findOrFail($id);

        // $model_categories = $model->categories->pluck('id');
        $model_subcategories = $model->subcategories->pluck('id');

        $categories = Category::all();

        // Capiz Cities and Municipalities
        $cities = City::where('provCode', 619)->get();

        $region = $model->region->regDesc ?? null;
        $province = $model->province->provDesc ?? null;

        return view('businesses::form', [
            'module' => $this->module,
            'method' => 'Update',
            'model' => $model,
            'categories' => $categories,
            'model_subcategories' => $model_subcategories,
            'cities' => $cities,
            'region' => $region,
            'province' => $province,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Business::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'contact_number' => 'required',
            'website' => 'required',
            'facebook_link' => 'required',
            'map_location' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'model_subcategories' => 'nullable',
            'street' => 'nullable',
            'city_id' => 'required',
            'barangay_id' => 'required',
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
                'name',
                'address',
                'contact_number',
                'website',
                'facebook_link',
                'map_location',
                'description',
                'category_id',
                'street',
                'city_id',
                'barangay_id',
            ]));

            $model->subcategories()->sync($request->model_subcategories);

            $model->full_address = $request->street . ', ' . $model->barangay->brgyDesc . ', ' . ucwords(Str::lower($model->city->citymunDesc)) . ', ' . ucwords(Str::lower($model->province->provDesc));
            $model->save();

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

            Business::destroy($request->id_array);

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
