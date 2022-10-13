<?php

namespace Modules\Subcategory\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Modules\Subcategory\Entities\Subcategory;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Categories\Entities\Category;

class SubcategoryController extends Controller
{
    public $module = 'Subcategory';

    public function index(Request $request)
    {
        if ($request->has('page')) {
            return $this->ajaxHandler($request);
        }

        return view('subcategory::index', [
            'module' => $this->module,
        ]);
    }

    public function ajaxHandler($request)
    {
        $query = Subcategory::whereNull('deleted_at');

        // Eager Loading
        $query->with('category');

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
        $categories = Category::all();

        return view('subcategory::form', [
            'module' => $this->module,
            'method' => 'Create',
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
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

            $model = Subcategory::create($request->only([
                'name',
                'category_id',
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
        $model = Subcategory::findOrFail($id)->load('category');

        return view('subcategory::show', [
            'module' => $this->module,
            'method' => 'View',
            'model' => $model,
        ]);
    }

    public function edit($id)
    {
        $model = Subcategory::findOrFail($id);

        $categories = Category::all();

        return view('subcategory::form', [
            'module' => $this->module,
            'method' => 'Update',
            'model' => $model,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Subcategory::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
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
                'category_id'
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

            Subcategory::destroy($request->id_array);

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
