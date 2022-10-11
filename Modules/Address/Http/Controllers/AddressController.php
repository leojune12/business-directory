<?php

namespace Modules\Address\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Address\Entities\Barangay;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public $module = 'Address';

    public function index(Request $request)
    {
        if ($request->q == 'barangay') {

            $barangays = Barangay::where('citymunCode', $request->parent_id)->get();

            return response()->json([
                'barangays' => $barangays,
            ]);
        }
    }

    // public function create()
    // {
    //     return view('address::form', [
    //         'module' => $this->module,
    //         'method' => 'Create',
    //     ]);
    // }

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Whoops!',
    //             'message' => 'Please complete the form.',
    //             'errors' => $validator->errors(),
    //             'old' => $request->all(),
    //         ]);
    //     }

    //     DB::beginTransaction();

    //     try {

    //         $model = Address::create($request->all());

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'title' => 'Success!',
    //             'message' => 'Item successfully created.'
    //         ]);
    //     } catch (Throwable $e) {

    //         // return $e;
    //         DB::rollBack();

    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Something went wrong!',
    //             'message' => 'Please try again.'
    //         ]);
    //     }
    // }

    // public function show($id)
    // {
    //     $model = Address::findOrFail($id);

    //     return view('address::show', [
    //         'module' => $this->module,
    //         'method' => 'View',
    //         'model' => $model,
    //     ]);
    // }

    // public function edit($id)
    // {
    //     $model = Address::findOrFail($id);

    //     return view('address::form', [
    //         'module' => $this->module,
    //         'method' => 'Update',
    //         'model' => $model,
    //     ]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $model = Address::findOrFail($id);

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Whoops!',
    //             'message' => 'Please complete the form.',
    //             'errors' => $validator->errors(),
    //             'old' => $request->all(),
    //         ]);
    //     }

    //     DB::beginTransaction();

    //     try {

    //         $model->update($request->all());

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'title' => 'Success!',
    //             'message' => 'Item successfully updated.'
    //         ]);
    //     } catch (Throwable $e) {

    //         return $e;
    //         DB::rollBack();

    //         return response()->json([
    //             'status' => 'error',
    //             'title' => 'Something went wrong!',
    //             'message' => 'Please try again.'
    //         ]);
    //     }
    // }

    // public function destroy(Request $request, $id)
    // {
    //     DB::beginTransaction();

    //     try {

    //         Address::destroy($request->id_array);

    //         DB::commit();

    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'Item deleted successfully.'
    //         ]);
    //     } catch (Throwable $e) {

    //         DB::rollBack();

    //         return response()->json([
    //             'status' => 'error',
    //             'message' => 'Whoops! Something went wrong. Please try again.'
    //         ]);
    //     }
    // }
}
