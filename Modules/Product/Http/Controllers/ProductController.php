<?php

namespace Modules\Product\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Modules\Product\Entities\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public $module = 'Product';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        return view('product::index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = Product::whereNull('deleted_at');

        $this->queryHandler($query, $request);

        $query->orderBy($request->orderBy ?? 'id', $request->orderType ?? 'DESC');

        return $query->paginate($request->perPage);
    }

    public function queryHandler($query, $request)
    {
        $query->when($request->name != 'null', function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->name . '%');
        });

        return $query;
    }

    public function create()
    {
        return view('product::form', [
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

            $model = Product::create($request->all());

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

        return view('product::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Product::findOrFail($id);

        return view('product::form', [
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

            $model->update($request->all());

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
