<?php

namespace Modules\Browse\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Entities\Product;
use Illuminate\Support\Facades\Validator;

class BrowseProductController extends Controller
{
    public $module = 'Products';

    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->ajaxHandler($request);
        }

        return view('browse::products.index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = DB::table('products');

        $query->whereNull('products.deleted_at');

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        $query->join('businesses', 'businesses.id', '=', 'products.business_id');

        $query->select(
            'products.*',
            'businesses.name as business_name',
            'businesses.full_address as business_full_address',
        );

        $this->queryHandler($query, $request);

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->product_name != 'null', function ($query) use ($request) {
            return $query->where('products.name', 'like', $request->product_name . '%');
        });

        $query->when($request->location != 'null', function ($query) use ($request) {
            return $query->where('businesses.full_address', 'like', '%' .$request->location . '%');
        });

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

            $model = Product::create($request->only([
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
        $model = Product::findOrFail($id);

        return view('browse::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Product::findOrFail($id);

        return view('browse::form', [
            'module' => $this->module,
            'method' => 'Update',
            'model' => $model,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Product::findOrFail($id);

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

            Product::destroy($request->id_array);

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
